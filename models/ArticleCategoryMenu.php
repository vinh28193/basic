<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;
use app\common\web\MenuInterface;
use app\models\resources\ArticleCategory;
use app\models\queries\ArticleCategoryQuery;
/**
 * ArticleCategorySearch represents the model behind the search form about `app\models\ArticleCategory`.
 */
class ArticleCategoryMenu extends ArticleCategory implements MenuInterface
{
    
    /**
     * @inheritdoc
     * @return \app\models\queries\ArticleCategoryQuery the active query used by this AR class.
     */
    public static function find()
    {
        return Yii::createObject(ArticleCategoryQuery::className(), [get_called_class()]);
    }

    private $_url;

    /**
     * setter
     */
    public function setUrl($url)
    {
        $this->_url = $url;
    }

    /**
     * @return mixed
     */
    public function getUrl()
    {
        if (!$this->_url) {
            $this->_url = Url::to("/categories/{$this->slug}", false);
        }
        return $this->_url;
    }

    /**
     * @return mixed
     */
    public function collect()
    {
        $query = self::find()->isParent()->all();
        return $this->getItemsRecursive($query);
    }

    private function getItemsRecursive($records)
    {
        $items = [];
        foreach ($records as $record) {
            $item = [];
            $item['label'] = Html::encode($record->title);
            $item['url'] = $record->url;
            if ($record->articleCategories) {
                $item = ArrayHelper::merge($item, [
                    'items' => $this->getItemsRecursive($record->articleCategories)
                ]);
            }
            $items[] = $item;
        }
        return $items;
    }
}
