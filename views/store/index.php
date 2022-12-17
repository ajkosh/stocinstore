<?php

use app\models\Store;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var app\models\StoreSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Stores';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-md-6">
        <div class="store-index">
            
            <h1><?= Html::encode($this->title) ?></h1>

            <p>
                <?= Html::a('Create Store', ['create'], ['class' => 'btn btn-success']) ?>
            </p>

            <?php Pjax::begin(['id' => 'store-index']); ?>
            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                
                    'code',
                    'store_name',
                    // 'store_locator_page_url:url',
                    'store_type_id',
                    //'is_active',
                    //'enable_for_find_in_store',
                    //'enable_for_store_locator',
                    //'store_image',
                    //'country',
                    //'region_code',
                    //'address_line_1',
                    //'address_line_2',
                    //'city',
                    //'postcode',
                    // [
                    //     'class' => ActionColumn::className(),
                    //     'urlCreator' => function ($action, Store $model, $key, $index, $column) {
                    //         return Url::toRoute([$action, 'id' => $model->id]);
                    //      }
                    // ],
                ],
            ]); ?>

            <?php Pjax::end(); ?>

        </div>
        </div>
        <div class="col-md-6">
        <?= $this->render('create', [
                'model' => $model,
            ]) ?>
        </div>    

</div>    
