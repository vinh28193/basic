<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\resources\File */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="thumbnail">
    <img src="<?=$model->getImageSrc($model->id, 300, 300)?>" alt="<?=$model->name?>">
    <div class="filename"><?=$model->name?></div>
</div>
