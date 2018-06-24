<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\resources\Product */

$this->title = Yii::t('title', 'Create Product');
$this->params['breadcrumbs'][] = ['label' => Yii::t('title', 'Products'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box box-default">
    <div class="box-body">
        <div class="product-create">
            <?= $this->render('_form/form', [
                'model' => $model,
            ]) ?>
        </div>
    </div>
</div>

