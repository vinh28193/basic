<?php
namespace app\common\widgets\cropper;

use yii\web\AssetBundle;

/**
 * CropperAsset
 * @see https://github.com/fengyuanchen/cropper
 */
class CropperAsset extends AssetBundle
{
    public $sourcePath = '@bower/cropper';
    public $css = [
        'dist/cropper.min.css',
    ];
    public $js = [
        'dist/cropper.min.js',
    ];
    public $depends = [
        'yii\web\JqueryAsset',
    ];
}