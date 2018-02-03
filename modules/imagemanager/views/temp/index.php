<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ListView;
use yii\widgets\Pjax;
use kartik\file\FileInput;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\imagemanage\models\ImageSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = Yii::t('app', 'images');
$this->params['breadcrumbs'][] = $this->title;
echo app\modules\imagemanager\widgets\ImageManagerWidget::widget([
    'dataProvider' => $dataProvider,
    'options' => [
        'id' => 'module-imagemanager',
        'class' => 'container-fluid'
    ],
]);
?>
