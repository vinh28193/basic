<?php

namespace app\common\data;

use Yii;
use yii\base\BaseObject;
use yii\base\InvalidConfigException;
use yii\helpers\Html;
use yii\helpers\Inflector;
use yii\web\Request;

class Filter extends BaseObject
{
    public $enableMultiFilter = false;
    public $filterParam = 'filter';

    public $attributes = [];
}