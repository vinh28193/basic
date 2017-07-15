<?php
namespace app\modules\manage\assets;

use yii\web\AssetBundle;

/**
 * Class OwlCarouselAsset
 * @package app\common\assets
 */
class OwlCarouselAsset extends AssetBundle
{
    public $sourcePath = '@bower/owl.carousel/dist';
    public $css = [
        'assets/owl.carousel.css'
    ];
    public $js = [
    	'owl.carousel.js'
    ];
    public $depends = [
        'yii\web\JqueryAsset',
        'yii\bootstrap\BootstrapPluginAsset',
    ];
}