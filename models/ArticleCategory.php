<?php

namespace app\models;

use Yii;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\behaviors\SluggableBehavior;
use yii\behaviors\TimestampBehavior;
use app\common\db\ActiveRecord;
use app\common\web\MenuInterface;
use app\models\queries\ArticleCategoryQuery;
/**
 * This is the model class for table "{{%article_category}}".
 *
 * @property integer $id
 * @property string $title
 * @property string $slug
 * @property integer $parent_id
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property Article[] $articles
 * @property ArticleCategory $parent
 * @property ArticleCategory[] $articleCategories
 */
class ArticleCategory extends ActiveRecord implements MenuInterface
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%article_category}}';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return ArrayHelper::merge(parent::behaviors(), [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'update_at',
            ],
            'slug' => [
                'class' => SluggableBehavior::className(),
                'attribute' => 'slug',
                'slugAttribute' => 'title',
                'ensureUnique' => true
            ]
        ]);
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['parent_id', 'status', 'created_at', 'updated_at'], 'integer'],
            [['title'], 'string', 'max' => 512],
            [['slug'], 'string', 'max' => 1024],
            [
                [
                    'parent_id'
                ], 
                'exist', 
                'skipOnError' => true, 
                'targetClass' => ArticleCategory::className(), 
                'targetAttribute' => [
                    'parent_id' => 'id'
                ]
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Title'),
            'slug' => Yii::t('app', 'Slug'),
            'parent_id' => Yii::t('app', 'Parent ID'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @inheritdoc
     * @return \app\models\queries\ArticleCategoryQuery the active query used by this AR class.
     */
    public static function find()
    {
        return Yii::createObject(ArticleCategoryQuery::className(), [get_called_class()]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getArticles()
    {
        return $this->hasMany(Article::className(), ['category_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParent()
    {
        return $this->hasOne(ArticleCategory::className(), ['id' => 'parent_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getArticleCategories()
    {
        return $this->hasMany(ArticleCategory::className(), ['parent_id' => 'id']);
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
