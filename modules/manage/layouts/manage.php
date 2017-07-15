<?php
use yii\helpers\ArrayHelper;
use app\modules\manage\assets\AdminLteAsset;
/* @var $this \yii\web\View */
/* @var $content string */
AdminLteAsset::register($this);
if(Yii::$app->controller->id === 'secure'){
/**
 * Do not use this code in your template. Remove it. 
 * Instead, use the code  $this->layout = '//manage-login'; in your controller.
 */
   echo $this->render('manage-login',['content' => $content]);
} else {
   echo $this->render('manage-content',['content' => $content]);
} ?>