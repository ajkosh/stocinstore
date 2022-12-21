<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use kartik\depdrop\DepDrop;
use yii\helpers\Url;
use kartik\file\FileInput;

/** @var yii\web\View $this */
/** @var app\models\Store $model */
/** @var yii\widgets\ActiveForm $form */

?>
<div class="store-form">

<?php $form = ActiveForm::begin([
        'action' => ['create'],
        'method' => 'post',
        'enableAjaxValidation' => true,
        'enableClientValidation' => true,
        'validationUrl' => Yii::$app->urlManager->createUrl('store/validate'),
        'options' => ['id' => 'store_form','enctype' => 'multipart/form-data']
    ]); ?>

    <?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'store_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'store_locator_page_url',)->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'store_type_id')->widget(Select2::classname(), [
            'data' => $model->getStoreTypeDropDownData(),
            'language' => 'en',
              'options' => ['placeholder' => Yii::t('app','Select Store Type...')],
                'pluginOptions' => [
                 'allowClear' => false
                ],
               
    ]);?>

 
    <?php echo $form->field($model, 'is_active')->checkbox(array(
                    'class'=>'cbx cbx-sm,',
                     'id'=>'is_active',
                    'labelOptions'=>array('style'=>'padding:5px;'),
                   
                    ))?>

    <?= $form->field($model, 'enable_for_find_in_store')->textInput() ?>

   
    <?php echo $form->field($model, 'enable_for_store_locator')->checkbox(array(
                    'class'=>'cbx cbx-sm,',
                     'id'=>'enable-store',
                    'labelOptions'=>array('style'=>'padding:5px;'),
                   
                    ))?>

<fieldset class="store-image">
    <?php echo $form->field($model, 'store_image',['enableAjaxValidation'=>false])->widget(FileInput::classname(), [
    'options' => ['accept' => 'image/jpg'],  
      'pluginOptions' => [
        'showPreview' => false,
        'showCaption' => true,
        'showRemove' => true,
        'showUpload' => false
    ]
]);?>
</fieldset>
 <fieldset class="address">
    <?php echo $form->field($model, 'country')->widget(Select2::classname(), [
            'data' => $model->getCountryDropDownData($model->store_name),
             
            'language' => 'en',
              'options' => ['placeholder' => Yii::t('app','Select Country...'),'id'=>'country-id',],
                'pluginOptions' => [
                 'allowClear' => false
                ],
               
    ]);?>
    
   <?php echo $form->field($model, 'region_code')->widget(DepDrop::classname(), [
    'pluginOptions'=>[
        'depends'=>['country-id'],
        'placeholder'=>'Select Region/State...',
        'url'=>Url::to(['/store/region'])
    ]
]);?>
    <?= $form->field($model, 'address_line_1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'address_line_2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'city')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'postcode')->textInput(['maxlength' => true]) ?>

</fieldset>
        <footer>
    <div class="bg-default content-box text-center">
     
     <?= Html::submitButton($model->isNewRecord ? Yii::t('app', '<i class="ace-icon fa fa-plus"> Save</i>') : Yii::t('app', '<i class="ace-icon fa fa-pencil"> Update</i>'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
     <?= Html::a('<i class="ace-icon fa fa-remove"> Cancel</i>', ['/store/index'], ['class'=>'btn  btn-danger']);?>
   </div>
   </footer>
 

    <?php ActiveForm::end(); ?>

</div>
<script>

</script>