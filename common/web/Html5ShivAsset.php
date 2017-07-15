<?php

namespace app\common\web;

use yii\web\AssetBundle;
/**
 * Class Html5shiv
 * @package app\common\web
 */
class Html5ShivAsset extends AssetBundle
{
    public $sourcePath = '@bower/html5shiv';
    
    public $js = [
        'dist/html5shiv.min.js'
    ];

    public $jsOptions = [
        'condition'=>'lt IE 9'
    ];

    public $depends = [
        'yii\web\JqueryAsset',
        'yii\bootstrap\BootstrapPluginAsset',
    ];
}