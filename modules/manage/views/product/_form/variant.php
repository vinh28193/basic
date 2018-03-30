<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use wbraganca\dynamicform\DynamicFormWidget;

/* @var $this yii\web\View */
/* @var $model app\models\resources\Product */
/* @var $form yii\widgets\ActiveForm */
?>

 <div class="col-md-4">
    <?= $form->field($model, 'thumbnail_path')->textInput(['maxlength' => true]) ?>
</div>
<div class="col-md-8">
    <?= $form->field($model, 'start_price')->textInput() ?>
    <?= $form->field($model, 'sell_price')->textInput() ?>
    <?= $form->field($model, 'quantity_available')->textInput() ?>
</div>