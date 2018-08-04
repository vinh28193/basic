<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
    ];
    public $js = [
    ];
    public $depends = [
        'app\common\web\CoreAsset',
        'app\common\web\FontAwesomeAsset',
        'app\common\web\Html5ShivAsset'
    ];

    /**
     * Registers this asset bundle with a view.
     * @param \app\common\web\View $view the view to be registered with
     * @return static the registered asset bundle instance
     * @throws \yii\base\InvalidConfigException
     */
    public static function register($view)
    {
        $view->registerJsConfig(require(__DIR__ . '/../config/jsConfigs.php'));
        return $view->registerAssetBundle(self::className());
    }
}
