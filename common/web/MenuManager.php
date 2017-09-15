<?php

namespace app\common\web;

use Yii;
use yii\base\Component;
use yii\caching\Cache;
use yii\helpers\Json;
use yii\helpers\ArrayHelper;
use yii\base\InvalidConfigException;
use yii\base\InvalidParamException;

/**
 * MenuManager manages menus configuration and loading.
 *
 * You can modify its configuration by adding an array to your application config under `components`
 * as shown in the following example:
 *
 * ```php
 * 'menuManager' => [
 *    // you can override MenuManager configs here
 * ]
 * ```
 * You can access that instance via `Yii::$app->menuManager`.
 */
class MenuManager extends Component
{
    public $homeLink = true;
    public $model;
    public $urlManager = 'urlManager';
    public $cache = 'cache';

    protected $cacheKey = __CLASS__;
    private $_items;

    /**
     * Initializes MenuManager.
     */
    public function init()
    {
        parent::init();

        if (Yii::$app->has($this->urlManager)) {
            $this->urlManager = Yii::$app->get($this->urlManager, false);
        }
        if (Yii::$app->has($this->cache)) {
            $this->cache = Yii::$app->get($this->cache, false);
        }
        if ($this->model instanceof \Closure) {
            $this->model = call_user_func($this->model, $this);
        } else {
            $this->model = Yii::createObject($this->model);
        }
    }

}