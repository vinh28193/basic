<?php

namespace app\models\queries;

use app\common\db\ActiveQuery;
use app\common\db\ActiveRecord;
/**
 * This is the ActiveQuery class for [[\app\models\ArticleCategory]].
 *
 * @see \app\models\ArticleCategory
 */
class ArticleCategoryQuery extends ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return \app\models\ArticleCategory[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \app\models\ArticleCategory|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    public function isParent(){
        /* @var $class ActiveRecord */
        $class = $this->modelClass;
        return $this->where($class::tableName().'.parent_id IS NULL');
    }
    public function notParent(){
        /* @var $class ActiveRecord */
        $class = $this->modelClass;
        return $this->where($class::tableName().'.parent_id IS NOT NULL');
    }
}
