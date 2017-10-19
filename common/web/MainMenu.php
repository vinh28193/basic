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
class MainMenu extends Object implements MenuInterface
{
    public $items = [
        ['label' => 'Home', 'url' => '/site/index'],
        ['label' => 'About us', 'url' => '/site/about'],
        ['label' => 'Contact', 'url' => '/site/contact'],
    ];
    public function collect()
    {
        return ArrayHelper::merge($this->items,[
            ['label' => 'Login', 'url' => '/manage/secure/login', 'visible' => Yii::$app->user->isGuest],
            ['label' => 'Logout', 'url' => '/manage/secure/logout', 'visible' => !Yii::$app->user->isGuest]
        ]);
    }
}