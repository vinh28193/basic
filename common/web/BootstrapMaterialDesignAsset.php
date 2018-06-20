<?php

namespace app\common\web;

use yii\web\AssetBundle;

class BootstrapMaterialDesignAsset extends AssetBundle
{
    public $sourcePath = '@bower/font-awesome';

    public $css = [
        'css/font-awesome.min.css'
    ];
    public $depends = [
        'yii\bootstrap\BootstrapAsset',
    ];
}