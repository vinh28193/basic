<?php
use yii\helpers\Html;
use kartik\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\UserProfile */
/* @var $imgSrc string */
/* @var $publicIdentity string */
?>

<div class="box box-primary">
    <div class="box-body">
        <?php echo Html::img($imgSrc, ['class' => 'img-responsive', 'alt' => $publicIdentity]);
        ?>
    </div>
    <!-- /.box-body -->
</div>
<!-- /.box -->
