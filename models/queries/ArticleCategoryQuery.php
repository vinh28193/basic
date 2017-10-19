<?php

namespace app\models\queries;

use app\common\db\ActiveQuery

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
}
