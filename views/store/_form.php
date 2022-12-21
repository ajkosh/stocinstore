<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use kartik\depdrop\DepDrop;
use yii\helpers\Url;
use kartik\file\FileInput;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var app\models\Store $model */
/** @var yii\widgets\ActiveForm $form */


$this->registerJs(
  '$(document).on("click","#enable-store", function () {
    if($(this).is(":checked")) {
      
      $(".store-image-field").show(300);
    } else {
      $(".store-image-field").hide(200);
    }
  });'
);
?>
<?php Pjax::begin(['id' => 'storeForm']); ?>
<div class="row">
	<?php $form = ActiveForm::begin([
	'action' => ['create'],
	'method' => 'post',
	'enableAjaxValidation' => true,
	'enableClientValidation' => true,
	'validationUrl' => Yii::$app->urlManager->createUrl('store/validate'),
	'options' => ['id' => 'store_form','enctype' => 'multipart/form-data']
	]); ?>

<!--Row with two equal columns-->
	<div class="row">
		<div class="col-md-6 ">
			<?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>
			<?= $form->field($model, 'store_locator_page_url',)->textInput(['maxlength' => true]) ?>
			<?php echo $form->field($model, 'is_active')->checkbox(array(
				'class'=>'cbx cbx-sm,',
				'id'=>'is_active',
				'labelOptions'=>array('style'=>'padding:5px;'),
			))?>
		</div>
		<div class="col-md-6">
			<?= $form->field($model, 'store_name')->textInput(['maxlength' => true]) ?>
			<?php echo $form->field($model, 'store_type_id')->widget(Select2::classname(), [
				'data' => $model->getStoreTypeDropDownData(),
				'language' => 'en',
				'options' => ['placeholder' => Yii::t('app','Select Store Type...')],
				'pluginOptions' => [
				'allowClear' => false
				],
			]);?>
			<?php echo $form->field($model, 'enable_for_find_in_store')->checkbox(array(
				'class'=>'cbx cbx-sm,',
				'id'=>'find-store-checkbox',
				'labelOptions'=>array('style'=>'padding:5px;'),
			))?>
		</div>
	</div>
    
    <div class="row">
    	<h4>Address</h4>
    	<div class="col-md-6">
			<?php echo $form->field($model, 'country')->widget(Select2::classname(), [
				'data' => $model->getCountryDropDownData($model->store_name),
				'language' => 'en',
				'options' => ['placeholder' => Yii::t('app','Select Country...'),'id'=>'country-id',],
				'pluginOptions' => [
					'allowClear' => false
				],
			]);?>
			<?= $form->field($model, 'address_line_1')->textarea(['rows' => 3]) ?>
			<?= $form->field($model, 'city')->textInput(['maxlength' => true]) ?>
			<?php echo $form->field($model, 'enable_for_store_locator')->checkbox(array(
				'class'=>'cbx',
				'id'=>'enable-store',
				'labelOptions'=>array('style'=>'padding:5px;'),
			))?>
        </div>
      <div class="col-md-6">
      		<?php echo $form->field($model, 'region_code')->widget(DepDrop::classname(), [
				'pluginOptions'=>[
				'depends'=>['country-id'],
				'placeholder'=>'Select Region/State...',
				'url'=>Url::to(['/store/region'])
				]
			]);?>
        	<?= $form->field($model, 'address_line_2')->textarea(['rows' => 3]) ?>
        	<?= $form->field($model, 'postcode')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 store-image-field">
			<?php echo $form->field($model, 'store_image',['enableAjaxValidation'=>false])->widget(FileInput::classname(), [
			'options' => ['accept' => 'image/jpg'],  
			'pluginOptions' => [
				'showPreview' => false,
				'showCaption' => true,
				'showRemove' => true,
				'showUpload' => false
				]
			]);?>
        </div>
    </div>  
    <footer>
		<div class="bg-default content-box text-center">
		
			<?= Html::submitButton($model->isNewRecord ? Yii::t('app', '<i class="ace-icon fa fa-plus"> Save</i>') : Yii::t('app', '<i class="ace-icon fa fa-pencil"> Update</i>'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
			<?= Html::a('<i class="ace-icon fa fa-remove"> Cancel</i>', ['/store/index'], ['class'=>'btn  btn-danger']);?>
		</div>
    	</footer>
<?php ActiveForm::end(); ?>
<?php Pjax::end(); ?>
</div>
          