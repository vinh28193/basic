<?php 
use yii\helpers\Html;
/* @var $this yii\web\View */
/* @var $model yii\data\ArrayDataProvider */
/* @var $key integer */
/* @var $index integer */
?>

<div class="col-xs-3 col-md-2">
    <a href="#" class="thumbnail" data-toggle=mediaSelector data-key="<?=$key;?>" >
      	<img src="<?= $model->src;?>" alt="<?= $model->name;?>">
    </a>
</div>