<?php
namespace app\common\db\mysql;

use yii\db\Query;
use yii\db\ActiveQuery;
use yii\helpers\ArrayHelper;

/**
 * QueryBuilder is the query builder behind the \yii\db\mysql\QueryBuilder for MySQL databases.
 */
class QueryBuilder extends \yii\db\mysql\QueryBuilder
{
    /**
     * @inheritdoc
     */
    public function build($query, $params = [])
    {
        $from = [];
        if($query instanceof ActiveQuery){
			$modelClass = $query->modelClass;
            $from[] = $modelClass::tableName();
        }else{
			if(ArrayHelper::keyExists('c', $query->from)){
                $from[] = 'c';
            } else {
                $from = $query->from;
            }
        }
        foreach ($from as $key => $f) {
            if (is_string($key)) {
                $f = $key;
            }
            $query->andWhere([
                $f . '.app_id'  => \Yii::$app->id,
            ]);
        }
        return parent::build($query, $params);
    }
    /**
     * @param array $joins
     * @param array $params
     * @return string
     * @throws \yii\db\Exception
     */
    public function buildJoin($joins, &$params)
    {
       foreach((array)$joins as $i => $join) {
            if (is_string($join[1])) {
                if (isset($join[2])) {
                    $join[2] = ['AND', $join[1] . '.app_id = ' . Yii::$app->id, $join[2]];
                } else {
                    $join[2] = $join[1] . '.app_id = ' . Yii::$app->id;
                }
                $joins[$i] = $join;
            }
        }
        return parent::buildJoin($joins, $params);
    }

    /**
     * @inheritdoc
     */
    public function insert($table, $columns, &$params)
    {
        $columns['app_id'] = Yii::$app->id;
        return parent::insert($table, $columns, $params);
    }

    /**
     * @param string $table
     * @param array $columns
     * @param array|string $condition
     * @param array $params
     * @return string
     */
    public function update($table, $columns, $condition, &$params)
    {
    	$condition = ['AND', $condition, ['app_id' => Yii::$app->id]];
    	$columns['app_id'] = Yii::$app->id;
        return parent::update($table, $columns, $condition, $params);
    }
    /**
     * @param string $table
     * @param array|string $condition
     * @param array $params
     * @return string
     */
    public function delete($table, $condition, &$params)
    {
    	$condition = ['AND', $condition, ['app_id' => Yii::$app->id]];
        return parent::delete($table, $condition, $params);
    }
}