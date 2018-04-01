<?php

namespace app\models\resources;

use Yii;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use app\common\db\ActiveRecord;
use yii\behaviors\SluggableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;

/**
 * This is the model class for table "{{%article}}".
 *
 * @property integer $id
 * @property string $title
 * @property string $slug
 * @property string $short_description
 * @property string $description
 * @property string $body
 * @property integer $view
 * @property integer $category_id
 * @property integer $author_id
 * @property integer $updater_id
 * @property integer $status
 * @property integer $published_at
 * @property integer $updated_at
 *
 * @property User $author
 * @property User $updater
 * @property ArticleCategory $category
 */
class Article extends ActiveRecord
{

    const STATUS_PUBLISHED = 1;
    const STATUS_DRAFT = 0;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%article}}';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return ArrayHelper::merge(parent::behaviors(), [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'published_at',
                'updatedAtAttribute' => 'updated_at',
            ],
            'slug' => [
                'class' => SluggableBehavior::className(),
                'attribute' => 'slug',
                'slugAttribute' => 'title',
                'ensureUnique' => true
            ],
            'blameable' => [
                'class' => BlameableBehavior::className(),
                'createdByAttribute' => 'author_id',
                'updatedByAttribute' => 'updater_id',
            ]
        ]);
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'body', 'category_id'], 'required'],
            [['description', 'body'], 'string'],
            [['view', 'category_id', 'author_id', 'updater_id', 'status', 'published_at', 'updated_at'], 'integer'],
            [['title'], 'string', 'max' => 512],
            [['slug', 'short_description'], 'string', 'max' => 1024],
            [
                [
                    'category_id'
                ], 
                'exist', 
                'skipOnError' => true, 
                'targetClass' => ArticleCategory::className(), 
                'targetAttribute' => [
                    'category_id' => 'id'
                ]
            ],
            [
                [
                    'author_id'
                ], 
                'exist', 
                'skipOnError' => true, 
                'targetClass' => User::className(), 
                'targetAttribute' => [
                    'author_id' => 'id'
                ]
            ],
            [
                [
                    'updater_id'
                ], 
                'exist', 
                'skipOnError' => true, 
                'targetClass' => User::className(), 
                'targetAttribute' => [
                    'updater_id' => 'id'
                ]
            ],
            [['published_at', 'updated_at'], 'default', 'value' => function () {
                return date(DATE_ISO8601);
            }],
            [['published_at', 'updated_at'], 'filter', 'filter' => 'strtotime', 'skipOnEmpty' => true],
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
            'short_description' => Yii::t('app', 'Short Description'),
            'description' => Yii::t('app', 'Description'),
            'body' => Yii::t('app', 'Body'),
            'view' => Yii::t('app', 'View'),
            'category_id' => Yii::t('app', 'Category ID'),
            'author_id' => Yii::t('app', 'Author ID'),
            'updater_id' => Yii::t('app', 'Updater ID'),
            'status' => Yii::t('app', 'Status'),
            'published_at' => Yii::t('app', 'Published At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(ArticleCategory::className(), ['id' => 'category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor()
    {
        return $this->hasOne(User::className(), ['id' => 'author_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUpdater()
    {
        return $this->hasOne(User::className(), ['id' => 'updater_id']);
    }   
}
