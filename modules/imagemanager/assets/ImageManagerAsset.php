<?php
namespace app\modules\imagemanager\assets;
use yii\web\AssetBundle;

/**
 * ImageManagerModuleAsset.
 */
class ImageManagerAsset extends AssetBundle
{
    public $sourcePath = '@imagemanager/assets/dist';
    public $css = [
		//'imagemanager.css',
    ];
    public $js = [
		'yii.imageManager.js',
    ];
    public $depends = [
		'yii\web\JqueryAsset',
        'yii\bootstrap\BootstrapPluginAsset',
    ];
}