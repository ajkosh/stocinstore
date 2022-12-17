<?php

namespace app\controllers;

use Yii;
use app\models\Store;
use app\models\StoreSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\widgets\ActiveForm;
use app\models\Region;
use yii\web\UploadedFile;

use yii\helpers\Url; 
/**
 * StoreController implements the CRUD actions for Store model.
 */
class StoreController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Store models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new StoreSearch();
        $model = new Store();
        $model->loadDefaultValues();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model' => $model
        ]);
    }

    /**
     * Displays a single Store model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionValidate() {

        $model = new Store();
    
        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format =  yii\web\Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }
   
    }
    /**
     * Creates a new Store model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Store();
      
       if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
        Yii::$app->response->format =  yii\web\Response::FORMAT_JSON;
        $transaction = \Yii::$app->db->beginTransaction();
        $model->store_image = UploadedFile::getInstance($model, 'store_image');
        try {
            if ($model->validate()) {
              
                $flag = $model->save(false);
                if ($flag == true) {
                    $transaction->commit();
                    if ($model->store_image ){
                      
                    $uploadedFileName = 'upload/'.$model->code.'.'.$model->store_image->extension; 
                    $model->store_image->saveAs($uploadedFileName);
                    }
                    
                    return array( 'status' => '200', 'type' => 'success', 'message' => 'Store created successfully.');
                } else {
                    $transaction->rollBack();
                }
            } else {
                return array('status' => '400', 'type' => 'warning', 'message' => 'Store can not created.');
            }
        } catch (Exception $ex) {
            $transaction->rollBack();
        }
    }
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Store model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Store model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Store model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Store the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Store::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionRegion() {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $out = [];

        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $cat_id = $parents[0];
                $out = Region::find()->select('region_id as id, name')
                ->where(["country"=>$cat_id])
                ->asArray()
                ->all(); 

                return ['output'=>$out, 'selected'=>''];
            }
        }
        return ['output'=>'', 'selected'=>''];
    }
}
