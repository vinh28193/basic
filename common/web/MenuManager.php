<?php

namespace app\common\web;

use Yii;
use yii\base\Arrayable;
use yii\base\Component;
use yii\caching\Cache;
use yii\helpers\Html;
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
 *    'menu1' => [
 *     // you can override MenuManager configs here
 *     ],
 * *    'menu2' => [
 *     // you can override MenuManager configs here
 *     ],
 *
 * ]
 * ```
 * You can access that instance via `Yii::$app->menuManager->menu1` `Yii::$app->menuManager->menu2`.
 */
class MenuManager extends Component
{
    public $homeLink = true;
    private $_collections = [
        'main' => [
            'class' => 'app\common\web\Menu'
        ]
    ];

    /**
     * Initializes MenuManager.
     */
    public function init()
    {
        parent::init();
    }

    /**
     * @param string $name
     * @return bool|mixed
     */
    public function __get($name){
        $collection = $this->getCollection($name);
        if($collection != false){
            return $collection;
        }
        return parent::__get($name);
    }

    /**
     * @param array $collections
     */
    public function setCollections(array $collections){
        $this->_collections = $collections;
    }

    /**
     * @return array
     */
    public function getCollections(){
        $collections = [];
        foreach (array_keys($this->_collections) as $name){
            $collections[$name] = $this->getCollection($name);
        }
        return $collections;
    }

    /**
     * @param string $name
     * @return bool|mixed
     */
    public function getCollection($name){
        if ($this->hasCollection($name)) {
            $this->_collections[$name] = $this->createCollection($this->_collections[$name]);
            return $this->_collections[$name];
        }
        return false;
    }

    /**
     * @param string $name
     * @return bool
     */
    public function hasCollection($name){
        return ArrayHelper::keyExists($name, $this->_collections);
    }

    protected function createCollection($config)
    {
        $class = ArrayHelper::remove($config,'class',false);
        if($class != false){
            return Yii::createObject($class,$config)->items;
        }
        return $config;
    }
}