<?php
namespace app\modules\mediamanager\assets;

use yii\web\AssetBundle;

/**
 * MediaManagerAsset.
 */
class MediaManagerAsset extends AssetBundle
{
    public $sourcePath = '@mediamanager/assets/dist';
    public $css = [
		'css/mediamanager.css',
    ];
    public $js = [
		'js/yii.mediaManager.js',
    ];
    public $depends = [
		'yii\web\JqueryAsset',
        'yii\bootstrap\BootstrapPluginAsset',
    ];
}