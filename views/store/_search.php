<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\StoreSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="store-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'code') ?>

    <?= $form->field($model, 'store_name') ?>

    <?= $form->field($model, 'store_locator_page_url') ?>

    <?= $form->field($model, 'store_type_id') ?>

    <?php // echo $form->field($model, 'is_active') ?>

    <?php // echo $form->field($model, 'enable_for_find_in_store') ?>

    <?php // echo $form->field($model, 'enable_for_store_locator') ?>

    <?php // echo $form->field($model, 'store_image') ?>

    <?php // echo $form->field($model, 'country') ?>

    <?php // echo $form->field($model, 'region_code') ?>

    <?php // echo $form->field($model, 'address_line_1') ?>

    <?php // echo $form->field($model, 'address_line_2') ?>

    <?php // echo $form->field($model, 'city') ?>

    <?php // echo $form->field($model, 'postcode') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
