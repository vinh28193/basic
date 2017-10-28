<?php

namespace app\models\queries;

use app\common\db\ActiveQuery;
use app\common\db\ActiveRecord;

/**
 * This is the ActiveQuery class for [[\app\models\Article]].
 *
 * @see \app\models\Article
 */
class ArticleQuery extends ActiveQuery
{
   public function published()
    {
        /* @var $class ActiveRecord */
        $class = $this->modelClass;
        $this->andWhere([$class::tableName().'.status' => $class::STATUS_PUBLISHED]);
        $this->andWhere(['<', $class::tableName().'.published_at', time()]);
        return $this;
    }
}
