<?php 
use yii\helpers\Html;
use yii\web\JsExpression;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ArrayDataProvider */

echo app\modules\mediamanage\widgets\MediaManageWidget::widget([
    'dataProvider' => $dataProvider,
    'options' => [
        'id' => 'media-manager',
        'class' => 'container-fluid media-grid-view'
      ]
]);
?>