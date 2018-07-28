<?php
/**
 * Created by PhpStorm.
 * User: vinhs
 * Date: 2018-07-28
 * Time: 21:57
 */

namespace app\common\web;

use Yii;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;

class View extends \yii\web\View {


    private $_pageTitle;

    /**
     * Holds all javascript configurations, which will be appended to the view.
     * @see View::endBody
     * @var type
     */
    private $jsConfig = [];

    /**
     * Sets current page title
     *
     * @param string $title
     */
    public function setPageTitle($title)
    {
        $this->_pageTitle = $title;
    }

    /**
     * Returns current page title
     *
     * @return string the page title
     */
    public function getPageTitle()
    {
        return (($this->_pageTitle) ? $this->_pageTitle . " - " : '') . Yii::$app->name;
    }

    public function registerJsConfig($module, $params = null)
    {
        if (is_array($module)) {
            foreach ($module as $moduleId => $value) {
                $this->registerJsConfig($moduleId, $value);
            }
            return;
        }

        if (isset($this->jsConfig[$module])) {
            $this->jsConfig[$module] = ArrayHelper::merge($this->jsConfig[$module], $params);
        } else {
            $this->jsConfig[$module] = $params;
        }
    }

    /**
     * Renders a string as Ajax including assets.
     *
     * @param string $content
     * @return string Rendered content
     */
    public function renderAjaxContent($content)
    {
        ob_start();
        ob_implicit_flush(false);

        $this->beginPage();
        $this->head();
        $this->beginBody();
        echo $content;
        $this->unregisterAjaxAssets();
        $this->endBody();
        $this->endPage(true);

        return ob_get_clean();
    }

    /**
     * @inheritdoc
     */
    public function renderAjax($view, $params = array(), $context = null)
    {
        $viewFile = $this->findViewFile($view, $context);

        ob_start();
        ob_implicit_flush(false);

        $this->beginPage();
        $this->head();
        $this->beginBody();
        echo $this->renderFile($viewFile, $params, $context);
        $this->unregisterAjaxAssets();
        $this->endBody();

        $this->endPage(true);

        return ob_get_clean();
    }

    /**
     * Unregisters standard assets on ajax requests
     */
    protected function unregisterAjaxAssets()
    {
        unset($this->assetBundles['yii\bootstrap\BootstrapAsset']);
        unset($this->assetBundles['yii\web\JqueryAsset']);
        unset($this->assetBundles['yii\web\YiiAsset']);
    }

    /**
     * @inheritdoc
     */
    public function registerJsFile($url, $options = array(), $key = null)
    {
        parent::registerJsFile($this->addCacheBustQuery($url), $options, $key);
    }

    /**
     * @inheritdoc
     */
    public function registerCssFile($url, $options = array(), $key = null)
    {
        parent::registerCssFile($this->addCacheBustQuery($url), $options, $key);
    }

    /**
     * Adds cache bust query string to given url if no query is present
     *
     * @param string $url
     * @return string the URL with cache bust paramter
     */
    protected function addCacheBustQuery($url)
    {
        if (strpos($url, '?') === false) {
            $file = str_replace('@web', '@webroot', $url);
            $file = Yii::getAlias($file);

            if (file_exists($file)) {
                $url .= '?v=' . filemtime($file);
            } else {
                $url .= '?v=' . urlencode(Yii::$app->version);
            }
        }

        return $url;
    }

    /**
     * @inheritdoc
     */
    protected function renderHeadHtml()
    {
        return (!Yii::$app->request->isAjax) ? Html::csrfMetaTags() . parent::renderHeadHtml() : parent::renderHeadHtml();
    }

    /**
     * @inheritdoc
     */
    public function endBody()
    {
        // Flush jsConfig needed for all types of requests (including pjax/ajax)
        $this->flushJsConfig();

        return parent::endBody();
    }

    /**
     * Writes the currently registered jsConfig entries and flushes the the config array.
     *
     * @since v1.2
     * @param string $key see View::registerJs
     */
    protected function flushJsConfig($key = null)
    {
        if(!empty($this->jsConfig)) {
            $this->registerJs("application.config.set(" . json_encode($this->jsConfig) . ");", View::POS_BEGIN, $key);
            $this->jsConfig = [];
        }
    }
}