<?php

namespace app\common\web;

use yii\web\AssetBundle;
/**
 * Class AnimateCss
 * @package app\common\web
 */
class AnimateCssAsset extends AssetBundle
{
    public $sourcePath = '@bower/animate.css';

    public $css = [
        'animate.min.css'
    ];
    
    public $depends = [
        'yii\bootstrap\BootstrapAsset',
    ];
}