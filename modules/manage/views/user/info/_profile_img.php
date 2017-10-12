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
        <?php echo Html::a(Html::img($imgSrc, ['class' => 'img-responsive', 'alt' => $publicIdentity,]), '#', [
            'id' => 'userAvatarThumb',
            'class' => 'box-profile',
            'data-toggle' => 'modal',
            'data-target' => '#userAvatarUploadModal'
        ]);
        ?>
        <!-- Modal -->
        <div class="modal fade" id="userAvatarUploadModal" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <?php
                    $uploadForm = ActiveForm::begin([
                        'id' => 'login-form',
                        'method' => 'post',
                        'action' => ['avatar-upload'],
                    ]);
                    ?>
                    <div class="modal-body">
                        <?php
                        echo $uploadForm->field($model, 'avatar')->fileInput();
                        ?>
                    </div>
                    <div class="modal-footer">
                        <?php
                        echo Html::button('Close', ['class' => 'btn btn-secondary', 'data-dismiss' => 'modal']);
                        echo Html::button('Save changes', ['class' => 'btn btn-primary ', 'id' => 'uploadButton']);
                        ?>
                    </div>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
    <!-- /.box-body -->
</div>
<!-- /.box -->
