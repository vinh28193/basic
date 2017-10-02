<?php

namespace app\common\web;

use Yii;
use yii\helpers\ArrayHelper;
use yii\base\Object;

/**
 * Class Menu
 * @package app\common\web
 *
 * @property integer $id
 * @property string $label
 * @property integer $encode
 * @property string $url
 * @property boolean $visible
 * @property string $icon
 * @property integer $parent_id
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property array $subItems;
 */
class Menu extends Object implements MenuInterface
{
    const IS_ROOT = 0;
    public $id;
    public $label;
    public $encode = true;
    public $url = '#';
    public $visible = false;
    public $icon = '';
    public $parent_id = self::IS_ROOT;
    public $status = 1;
    public $created_at;
    public $updated_at;

    public $subItems;

    private $_items = [
        ['id' => 1, 'label' => 'Home', 'encode' => 1, 'url' => '/site/index', 'visible' => 1, 'icon' => 'glyphicon glyphicon-lock', 'parent_id' => 0, 'status' => 1, 'created_at' => '1506397470', 'updated_at' => '1506397470'],
        ['id' => 2, 'label' => 'About', 'encode' => 1, 'url' => '/site/about', 'visible' => 1, 'icon' => 'glyphicon glyphicon-lock', 'parent_id' => 0, 'status' => 1, 'created_at' => '1506397470', 'updated_at' => '1506397470'],
        ['id' => 3, 'label' => 'Contact', 'encode' => 1, 'url' => '/site/contact', 'visible' => 1, 'icon' => 'glyphicon glyphicon-lock', 'parent_id' => 0, 'status' => 1, 'created_at' => '1506397470', 'updated_at' => '1506397470'],
        ['id' => 4, 'label' => 'Link', 'encode' => 1, 'url' => '#', 'visible' => 1, 'icon' => 'glyphicon glyphicon-lock', 'parent_id' => 0, 'status' => 1, 'created_at' => '1506397470', 'updated_at' => '1506397470'],
        ['id' => 5, 'label' => 'SubLink', 'encode' => 1, 'url' => '/site/link/1', 'visible' => 1, 'icon' => 'glyphicon glyphicon-lock', 'parent_id' => 4, 'status' => 1, 'created_at' => '1506397470', 'updated_at' => '1506397470'],
        ['id' => 6, 'label' => 'SubLink', 'encode' => 1, 'url' => '/site/link/2', 'visible' => 1, 'icon' => 'glyphicon glyphicon-lock', 'parent_id' => 4, 'status' => 1, 'created_at' => '1506397470', 'updated_at' => '1506397470'],
        ['id' => 7, 'label' => 'Link2', 'encode' => 1, 'url' => '/site/link2', 'visible' => 1, 'icon' => 'glyphicon glyphicon-lock', 'parent_id' => 0, 'status' => 1, 'created_at' => '1506397470', 'updated_at' => '1506397470'],
    ];


    public function collect()
    {
        $this->_items = $this->getItemRecursive($this->_items, self::IS_ROOT);
        $addMore = [
            ['id' => 8, 'label' => 'Login', 'encode' => 1, 'url' => '/manage/secure/login', 'visible' => Yii::$app->user->isGuest, 'icon' => 'glyphicon glyphicon-lock', 'parent_id' => 0, 'status' => 1, 'created_at' => '1506397470', 'updated_at' => '1506397470'],
            ['id' => 9, 'label' => 'Logout', 'encode' => 1, 'url' => '/manage/secure/logout', 'visible' => !Yii::$app->user->isGuest, 'icon' => 'glyphicon glyphicon-lock', 'parent_id' => 0, 'status' => 1, 'created_at' => '1506397470', 'updated_at' => '1506397470'],
        ];
        $this->_items = ArrayHelper::merge($this->_items,$addMore);
        return $this->_items;
    }

    private function getItemRecursive($records, $parent_id)
    {
        $items = [];
        foreach ($records as $record) {
            if ($record['parent_id'] == $parent_id) {
                $item = $record;

                $subItems = $this->getItemRecursive($records, $record['id']);
                if ($subItems) {
                    $item = ArrayHelper::merge($item, ['items' => $subItems]);
                }
                $items[] = $item;
            }
        }
        return $items;
    }

    public function getNavbar(){

    }
}