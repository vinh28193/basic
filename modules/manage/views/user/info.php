<?php
use yii\helpers\Html;
use kartik\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = $model->publicIdentity;
$this->params['breadcrumbs'][] = $this->title;
$cssCustom = <<<CSS

CSS;
?>
<div class="row">
    <div class="col-md-3">

        <!-- Profile Image -->
        <div class="box box-primary">
            <div class="box-body">
                <?= Html::a(Html::img($model->avatarPath,['class' => 'img-responsive', 'alt' => $model->publicIdentity,]),'#',[
                    'id' => 'userAvatarThumb',
                    'class' => 'box-profile',
                    'data-toggle'=>'modal',
                    'data-target'=>'#userAvatarUploadModal'
                ]);
                ?>
                <!-- Modal -->
                <div class="modal fade" id="userAvatarUploadModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                    echo $uploadForm->field($model->userProfile,'avatar')->fileInput();
                                ?>
                            </div>
                            <div class="modal-footer">
                                <?php
                                    echo Html::button('Close',['class' => 'btn btn-secondary' , 'data-dismiss' => 'modal']);
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

        <!-- About Me Box -->
        <div class="box box-primary">
            <div class="box-header with-border">
                <?=Html::tag('h3',"<b>{$model->userProfile->first_name}</b>'s Information",['class' => 'box-title'])?>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-sm btn-box-tool"><i class="fa fa-fw fa-edit"></i></button>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <strong><i class="fa fa-book margin-r-5"></i>Name</strong>

                <p class="text-muted">
                    <?=$model->userProfile->fullName;?>
                </p>

                <hr>

                <strong><i class="fa fa-file-text-o margin-r-5"></i> Birthday</strong>

                <p class="text-muted"><?=$model->userProfile->birthday;?></p>

                <hr>

                <strong><i class="fa fa-map-marker margin-r-5"></i> Address</strong>

                <p class="text-muted"><?=$model->userProfile->address;?></p>

                <hr>

                <strong><i class="fa fa-pencil margin-r-5"></i> Phone</strong>

                <p class="text-muted"><?=$model->userProfile->phone;?></p>

                <hr>
                <strong><i class="fa fa-pencil margin-r-5"></i> Bio</strong>

                <p class="text-muted"><?=$model->userProfile->bio;?></p>

            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
    <!-- /.col -->
    <div class="col-md-9">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#activity" data-toggle="tab">Activity</a></li>
                <li><a href="#timeline" data-toggle="tab">Timeline</a></li>
                <li><a href="#settings" data-toggle="tab">Settings</a></li>
            </ul>
            <div class="tab-content">
                <div class="active tab-pane" id="activity">
                    <!-- Post -->
                    <!-- /.post -->
                </div>
                <!-- /.tab-pane -->
                <div class="tab-pane" id="timeline">
                    <!-- The timeline -->
                </div>
                <!-- /.tab-pane -->

                <div class="tab-pane" id="settings">
                </div>
                <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
        </div>
        <!-- /.nav-tabs-custom -->
    </div>
    <!-- /.col -->
</div>

