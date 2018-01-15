<?php
namespace app\common\db\mysql;

/**
 * Schema is the class behind the \yii\db\mysql\Schema for retrieving metadata from a MySQL database.
 */
class Schema extends \yii\db\mysql\Schema
{
    /**
     * Creates a query builder for the MSSQL database.
     * @return QueryBuilder query builder interface.
     */
    public function createQueryBuilder()
    {
        return new QueryBuilder($this->db);
    }
}