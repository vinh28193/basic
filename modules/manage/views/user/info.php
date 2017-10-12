<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = $model->publicIdentity;
$this->params['breadcrumbs'][] = $this->title;
$cssCustom = <<<CSS

CSS;
echo Html::hiddenInput('_UserID',$model->getId());
?>
<div class="row">
    <div class="col-md-3">
        <!-- Profile Image -->
        <?=$this->render('_info/profile_img',[
            'imgSrc' => $model->avatarPath,
            'publicIdentity' => $model->publicIdentity,
            'model' => $model->userProfile
        ]);?>
        <!-- About Me Box -->
        <?=$this->render('_info/profile',[
            'model' => $model->userProfile
        ]);?>

    </div>
    <!-- /.col -->
    <div class="col-md-9">
        <?=$this->render('_info/multi_tabs',[

        ])?>
    </div>
    <!-- /.col -->
</div>

