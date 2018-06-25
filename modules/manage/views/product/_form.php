<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\FileInput;
use wbraganca\dynamicform\DynamicFormWidget;

/* @var $this yii\web\View */
/* @var $model app\models\resources\Product */
/* @var $form yii\widgets\ActiveForm */
?>
<?php $form = ActiveForm::begin([
    'options' => [
        'id' => 'product-form'
    ]
]); ?>
<div class="product-form row">
<div class="col-md-6">
    <div class="box box-solid">
        <div class="box-header with-border">
            <h3 class="box-title">Image</h3>
        </div>
        <div class="box-body">
            <?php
                echo $form->field($model,'thumbnail')->widget(FileInput::className(),[
                    'pluginOptions' => [
                        'showClose' => false,
                        'showCaption' => false,
                        'showBrowse' => false,
                        'browseOnZoneClick' => true,
                        'overwriteInitial' => true,
                        'maxFileSize' => '1500',
                        'removeLabel'=> '',
                        'removeIcon'=> '<i class="glyphicon glyphicon-remove"></i>',
                        'removeTitle'=> 'Cancel or reset changes',
                        'elErrorContainer' => '#kv-avatar-errors-2',
                        'msgErrorClass' => 'alert alert-block alert-danger',
                        'defaultPreviewContent' => '<img src="/no-image.jpg" alt="Your Avatar"><h6 class="text-muted">Click to select</h6>',
                        'layoutTemplates' => "{'main2: {preview} {remove} {browse}'}",
                        'allowedFileExtensions' => ["jpg", "png", "gif"],
                        'frameClass' => 'col-md-12'
                    ],
                ]);
            ?>
        </div>
    </div>
</div>
<div class="col-md-6">
    <div class="box box-solid">
        <div class="box-header with-border">
            <h3 class="box-title">Information</h3>
        </div>
        <div class="box-body">

        </div>
    </div>
</div>
    
    



</div>
<?php ActiveForm::end(); ?>