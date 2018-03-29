<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\resources\Product */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-form">

    <?php $form = ActiveForm::begin([
            'options' => [
                'id' => 'product-form'
            ]
    ]); ?>
    <div class="row">
        <div class="col-md-9">
            <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
            <div class="row">
                <div class="col-md-4">
                    <?= $form->field($model, 'thumbnail_path')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-8">
                    <?= $form->field($model, 'start_price')->textInput() ?>
                    <?= $form->field($model, 'sell_price')->textInput() ?>
                    <?= $form->field($model, 'quantity_available')->textInput() ?>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'category_id')->textInput() ?>
            <?= $form->field($model, 'deal_time')->textInput() ?>
            <?= $form->field($model, 'is_free_shipping')->textInput() ?>
            <div class="form-group">
                <?= Html::button(Yii::t('app', 'Back To List'), ['class' => 'btn btn-primary']) ?>
                <?= Html::button(Yii::t('app', 'Draft'), ['class' => 'btn btn-default']) ?>
                <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
            </div>
        </div>
        <div class="col-md-12">
            <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>
        </div>
    </div>
    
    

    <?php ActiveForm::end(); ?>

</div>
