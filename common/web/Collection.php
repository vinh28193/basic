<?php 
namespace app\common\web;

use Yii;
use yii\db\Query;
use yii\di\Instance;
use yii\db\Connection;
use yii\base\InvalidConfigException;
use yii\data\ArrayDataProvider;
class Collection extends \yii\base\Model
{
	
	private $_query;
	public function getQuery()
	{
		return $this->_query;
	}
	public function setQuery($query)
	{
		$this->_query = $query;
	}

	private $_sort;
	public function getSort()
	{
		return $this->_sort;
	}
	public function setSort($sort)
	{
		$this->_sort = $sort;
	}

	private $_filter;
	public function getFilter()
	{
		return $this->_filter;
	}
	public function setFilter($filter)
	{
		$this->_query = $filter;
	}
	private function prepareInit(){

	}
	public function expletive($params)
	{

	}
}