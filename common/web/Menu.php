<?php

namespace app\common\web;

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
class Menu extends Object
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


    public function getItems()
    {
        $this->_items = $this->getItemsRecursive($this->_items, self::IS_ROOT);
        return $this->_items;
    }

    private function getItemsRecursive($records, $parent_id)
    {
        $items = [];
        foreach ($records as $record) {
            if ($record['parent_id'] == $parent_id) {
                $item = (array)$record;

                $subItems = $this->getItemsRecursive($records, $record['id']);
                if ($subItems) {
                    $item = array_merge($item, ['items' => $subItems]);
                }
                $items[] = $item;
            }
        }
        return $items;
    }

    public function getNavbar(){

    }
}