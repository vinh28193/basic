<?php

use yii\helpers\Html;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $model \app\models\resources\Product */

echo Html::a($model->title,['/top/view',['id' => $model->id]]);
?>


