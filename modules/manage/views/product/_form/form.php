<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use wbraganca\dynamicform\DynamicFormWidget;

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
                <?= $this->render('variant',[
                    'form' => $form,
                    'model' => $model
                ]);?>
            </div>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'category_id')->textInput() ?>
            <?= $form->field($model, 'deal_time')->textInput() ?>
            <?= $form->field($model, 'is_free_shipping')->textInput() ?>
            <div class="form-group">
                <?= Html::button(Yii::t('form', 'Back To List'), ['class' => 'btn btn-primary']) ?>
                <?= Html::button(Yii::t('form', 'Draft'), ['class' => 'btn btn-default']) ?>
                <?= Html::submitButton(Yii::t('form', 'Save'), ['class' => 'btn btn-success']) ?>
            </div>
        </div>
        <div class="col-md-12">
            <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>
        </div>
    </div>
    
    

    <?php ActiveForm::end(); ?>

</div>
