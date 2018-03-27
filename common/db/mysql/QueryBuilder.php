<?php
namespace app\common\db\mysql;

use Yii;
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
        if(!empty($query->from)) {
            if(ArrayHelper::keyExists('c', $query->from)){
                $from[] = 'c';
            } else {
                $from = $query->from;
            }
        } elseif ($query instanceof ActiveQuery) {
            $modelClass = $query->modelClass;
            $from[] = $modelClass::tableName();
        }
        $filteredFrom = [];
        foreach($from as $key => $f) {
            if (!$f instanceof Query && !$this->isExcludeTable($f)) {
                $filteredFrom[$key] = $f;
            }
        }
        foreach ($filteredFrom as $key => $tableName) {
            if (is_string($key)) {
                $tableName = $key;
            }
            $query->andWhere([
                $tableName . '.' . Yii::$app->tenant->primaryKey  => Yii::$app->tenant->id,
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
       if (isset(Yii::$app->tenant)) {
            foreach((array)$joins as $i => $join) {
                if (is_string($join[1])) {
                    if (in_array($join[1], Yii::$app->tenant->excludeTables)) break;
                    if (isset($join[2])) {
                        $join[2] = ['and', $join[1] . '.tenant_id = ' . Yii::$app->tenant->id, $join[2]];
                    } else {
                        $join[2] = $join[1] . '.tenant_id = ' . Yii::$app->tenant->id;
                    }
                    $joins[$i] = $join;
                }
            }
        }
        return parent::buildJoin($joins, $params);
    }

    /**
     * @inheritdoc
     */
    public function insert($table, $columns, &$params)
    {
        if(!$this->isExcludeTable($table)) {
            $columns[Yii::$app->tenant->primaryKey] = Yii::$app->tenant->id;
        }
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
    	if (!$this->isExcludeTable($table)) {
            $condition = ['and', $condition, [Yii::$app->tenant->primaryKey => Yii::$app->tenant->id]];
            $columns[Yii::$app->tenant->primaryKey] = Yii::$app->tenant->id;
        }
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
    	if (!$this->isExcludeTable($table)) {
            $condition = ['and', $condition, [Yii::$app->tenant->primaryKey => Yii::$app->tenant->id]];
        }
        return parent::delete($table, $condition, $params);
    }

    /**
     * @param $table
     * @return bool
     */
    private function isExcludeTable($table)
    {
        if (in_array($table, \Yii::$app->tenant->excludeTables)) {
            return true;
        }
        $tableName = preg_replace_callback(
            '/\\{\\{(%?[\w\-\. ]+%?)\\}\\}/',
            function ($matches) {
                return str_replace('%', $this->db->tablePrefix, $matches[1]);
            },
            $table
        );
        return in_array($tableName, Yii::$app->tenant->excludeTables);
    }
}