<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ListView;
use yii\widgets\Pjax;
use kartik\file\FileInput;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\imagemanage\models\ImageSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'images');
$this->params['breadcrumbs'][] = $this->title;
?>
<div id="imagemanage" class="container-fluid <?=$selectType?>">
    <div class="row">
        <div class="col-xs-6 col-sm-10 col-image-editor">
            <div class="image-cropper">
                <div class="image-wrapper">
                    <img id="image-cropper" />
                </div>
                <div class="action-buttons">
                    <a href="#" class="btn btn-primary apply-crop">
                        <i class="fa fa-crop"></i>
                        <span class="hidden-xs">Crop</span>
                    </a>
                    <?php if($viewMode === "iframe"): ?>
                    <a href="#" class="btn btn-primary apply-crop-select">
                        <i class="fa fa-crop"></i>
                        <span class="hidden-xs">Crop and select></span>
                    </a>
                    <?php endif; ?>
                    <a href="#" class="btn btn-default cancel-crop">
                        <i class="fa fa-undo"></i>
                        <span class="hidden-xs">Cancel</span>
                    </a>
                </div>
            </div> 
        </div>
        <div class="col-xs-6 col-sm-10 col-overview">
            <?php Pjax::begin([
                'id'=>'pjax-imagemanage',
                'timeout'=>'5000'
            ]); ?>    
            <?= ListView::widget([
                'dataProvider' => $dataProvider,
                'itemOptions' => ['class' => 'item img-thumbnail'],
                'layout' => "<div class='item-overview'>{items}</div> {pager}",
                'itemView' => function ($model, $key, $index, $widget) {
                    return $this->render("_image", ['model' => $model]);
                },
            ]) ?>
            <?php Pjax::end(); ?>
        </div>
        <div class="col-xs-6 col-sm-2 col-options">
            <div class="form-group">
                <?=Html::textInput('input-imagemanage-search', null, ['id'=>'input-imagemanage-search', 'class'=>'form-control', 'placeholder'=>'Search...'])?>
            </div>
            <?=FileInput::widget([
                'name' => 'image-manager[]',
                'id' => 'image-manager',
                'options' => [
                    'multiple' => true,
                    'accept' => 'image/*'
                ],
                'pluginOptions' => [
                    'uploadUrl' => Url::to(['imagemanager/image/upload']),
                    'allowedimageExtensions' => ['jpg', 'jpeg', 'gif', 'png'], 
                    'uploadAsync' => false,
                    'showPreview' => false,
                    'showRemove' => false,
                    'showUpload' => false,
                    'showCancel' => false,
                    'browseClass' => 'btn btn-primary btn-block',
                    'browseIcon' => '<i class="fa fa-upload"></i> ',
                    'browseLabel' =>'Upload'
                ],
                'pluginEvents' => [
                    "imagebatchselected" => "function(event, images){  $('.msg-invalid-image-extension').addClass('hide'); $(this).imageinput('upload'); }",
                    "imagebatchuploadsuccess" => "function(event, data, previewId, index) {
                        imageManagerModule.uploadSuccess(data.jqXHR.responseJSON.imagemanagerimages);
                    }",
                    "imageuploaderror" => "function(event, data) { $('.msg-invalid-image-extension').removeClass('hide'); }",
                ],
            ]) ?>
            <div class="image-info hide">
                <div class="thumbnail">
                    <img src="#">
                </div>
                <div class="edit-buttons">
                    <a href="#" class="btn btn-primary btn-block crop-image-item">
                        <i class="fa fa-crop"></i>
                        <span class="hidden-xs">Crop</span>
                    </a>
                </div>
                <div class="details">
                    <div class="imageName"></div>
                    <div class="created"></div>
                    <div class="imageSize"></div>
                    <div class="dimensions">
                        <span class="dimension-width"></span> &times; <span class="dimension-height"></span>
                    </div>
                    <a href="#" class="btn btn-xs btn-danger delete-image-item" >
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Delete
                    </a>
                </div>
                <?php if($viewMode === "iframe"): ?>
                <a href="#" class="btn btn-primary btn-block pick-image-item">Select</a> 
                <?php endif; ?>
            </div>
        </div>  
    </div>
</div>  
