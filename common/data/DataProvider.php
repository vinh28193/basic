<?php
namespace app\common\data;

use Yii;
use yii\data\Sort;
use yii\data\Pagination;
use yii\data\ActiveDataProvider;
use yii\base\InvalidConfigException;
use yii\base\Model;
use yii\db\ActiveQueryInterface;
use yii\db\Connection;
use yii\db\QueryInterface;
use yii\di\Instance;

class DataProvider extends  ActiveDataProvider
{

}