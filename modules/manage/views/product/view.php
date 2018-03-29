<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\resources\Product */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Products'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'tenant_id',
            'sku',
            'title',
            'slug',
            'description:ntext',
            'category_id',
            'seller_id',
            'updater_id',
            'thumbnail_base_path',
            'thumbnail_path',
            'start_price',
            'sell_price',
            'quantity_available',
            'quantity_sold',
            'deal_time:datetime',
            'condition_id',
            'is_free_shipping',
            'status',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
