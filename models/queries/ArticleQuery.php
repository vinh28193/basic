<?php

namespace app\models\queries;

/**
 * This is the ActiveQuery class for [[\app\models\Article]].
 *
 * @see \app\models\Article
 */
class ArticleQuery extends \yii\db\ActiveQuery
{
   public function published()
    {
        /* @var $class \yii\db\ActiveRecord */
        $class = $this->modelClass;
        $this->andWhere([$class::tableName().'.status' => $class::STATUS_PUBLISHED]);
        $this->andWhere(['<', $class::tableName().'.published_at', time()]);
        return $this;
    }
}
