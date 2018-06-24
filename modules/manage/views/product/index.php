<?php

use yii\helpers\Html;
use app\common\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\manage\models\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Products');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box box-primary">
    <div class="box-body">
        <?php  echo $this->render('_search', ['model' => $searchModel]); ?>
    </div>
</div>
<div class="box box-solid">
    <div class="box-header with-border">
        <h3 class="box-title"><?=$this->title;?></h3>
        <div class="box-tools pull-right">
            <div class="has-feedback">
                <input type="text" class="form-control input-sm" placeholder="Search Mail">
                <span class="glyphicon glyphicon-search form-control-feedback"></span>
            </div>
        </div>
        <!-- /.box-tools -->
    </div>
    <div class="box-body no-padding">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'options' => [
                    'class' => 'table-responsive',
            ],
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'id',
                'tenant_id',
                'sku',
                'title',
                'slug',
                //'description:ntext',
                //'category_id',
                //'seller_id',
                //'updater_id',
                //'thumbnail_base_path',
                //'thumbnail_path',
                //'start_price',
                //'sell_price',
                //'quantity_available',
                //'quantity_sold',
                //'deal_time:datetime',
                //'condition_id',
                //'is_free_shipping',
                //'status',
                //'created_at',
                //'updated_at',

                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]); ?>
        <div class="input-group">
            <?= Html::a(Yii::t('app', 'Create Product'), ['create'], ['class' => 'btn btn-success']) ?>
        </div>
    </div>

</div>
