<?php
namespace app\modules\mediamanage\assets;

use yii\web\AssetBundle;

/**
 * MediaManagerAsset.
 */
class MediaManageAsset extends AssetBundle
{
    public $sourcePath = '@mediamanage/assets/dist';
    public $css = [
		'css/mediamanage.css',
    ];
    public $js = [
		'js/yii.mediaManage.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
		'yii\web\JqueryAsset',
        'yii\bootstrap\BootstrapPluginAsset',
    ];
}