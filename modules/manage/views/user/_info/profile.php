<?php
use yii\helpers\Html;
/* @var $this yii\web\View */
/* @var $model app\models\UserProfile */
$formatter = Yii::$app->formatter;
?>
<div class="box box-primary">
    <div class="box-header with-border">
        <?= Html::tag('h3', "<b>{$model->first_name}</b>'s Information", ['class' => 'box-title']) ?>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-sm btn-box-tool"><i class="fa fa-fw fa-edit"></i></button>
        </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <strong><i class="fa fa-book margin-r-5"></i>Name</strong>
        <p class="text-muted"><?= $model->fullName; ?></p>
        <hr>

        <strong><i class="fa fa-file-text-o margin-r-5"></i> Birthday</strong>
        <p class="text-muted"><?= $formatter->asDate($model->birthday); ?></p>
        <hr>

        <strong><i class="fa fa-map-marker margin-r-5"></i> Address</strong>
        <p class="text-muted"><?= $model->address; ?></p>
        <hr>

        <strong><i class="fa fa-pencil margin-r-5"></i> Phone</strong>
        <p class="text-muted"><?= $model->phone; ?></p>
        <hr>
        <strong><i class="fa fa-pencil margin-r-5"></i> Bio</strong>

        <p class="text-muted"><?= $model->bio; ?></p>
    </div>
    <!-- /.box-body -->
</div>
<!-- /.box -->
