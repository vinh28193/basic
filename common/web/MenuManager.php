<?php

namespace app\common\web;

use Yii;
use ArrayIterator;
use IteratorAggregate;
use yii\base\Arrayable;
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
class MenuManager extends Component implements IteratorAggregate
{
    public $homeLink = true;
    public $cache = 'cache';

    protected $cacheKey = __CLASS__;
    private $_collections = [
        'main' => [
            'class' => 'app\models\Category'
        ]
    ];

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
    }
    public function getIterator() {
        return new ArrayIterator($this->_collections);
    }
    public function setCollections(array $collections){
        $this->_collections = $collections;
    }
}