<?php

namespace app\common\web;

use yii\web\AssetBundle;
/**
 * Class Slimcroll
 * @package app\common\web
 */
class SlimcrollAsset extends AssetBundle
{
    public $sourcePath = '@bower/slimscroll';
    public $js = [
        'jquery.slimscroll.min.js'
    ];
    public $depends = [
        'yii\web\JqueryAsset',
        'yii\bootstrap\BootstrapPluginAsset',
    ];
}