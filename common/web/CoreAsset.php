<?php

namespace app\common\web;

use yii\web\AssetBundle;
use yii\web\View;
class CoreAsset extends AssetBundle
{
    /**
     * @inheritdoc
     */
    public $sourcePath = '@app/common/assets';

    /**
     * @inheritdoc
     */
    public $css = [];


    /**
     * @inheritdoc
     */
    public $js = [
        'js/application.core.js',
        'js/application.util.js',
        'js/application.log.js',
    ];

    /**
     * @inheritdoc
     */
    public $jsOptions = ['position' => View::POS_HEAD];

    /**
     * @inheritdoc
     */
    public $depends = [
        'yii\web\YiiAsset',
        'yii\web\JqueryAsset',
        'yii\bootstrap\BootstrapAsset',
        'yii\bootstrap\BootstrapPluginAsset',
    ];
}