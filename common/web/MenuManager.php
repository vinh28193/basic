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
 *      'class' => 'app\common\web\MenuManager',
 *      'collections' => [
 *           'menu1' => [
 *                'class' => 'app\common\web\Menu1'
 *           ],
 *           'menu2' => [
 *                'class' => 'app\common\web\Menu2'
 *            ],
 *      ]
 * ]
 * ```
 * You can access that instance via `Yii::$app->menuManager->menu1` `Yii::$app->menuManager->menu2`.
 */
class MenuManager extends Component
{

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
        if($this->hasCollection($name)){
            return $this->getCollection($name);
        }
        return parent::__get($name);
    }

    /**
     * array|object|MenuInterface
     */
    private $_collections;

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

    /**
     * Creates collection instance from its array configuration.
     * @param array $config collection instance configuration.
     * @return array|object the array or collection object instance.
     */
    protected function createCollection($config)
    {
        $class = ArrayHelper::remove($config,'class',false);
        if($class != false){
            $menu = Yii::createObject($class,$config);
            if($menu instanceof MenuInterface){
                /* @var $menu MenuInterface*/
                return $menu->collect();
            }
            return $menu;
        }
        return $config;
    }
}