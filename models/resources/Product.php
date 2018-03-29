<?php

namespace app\models\resources;

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
use yii\behaviors\SluggableBehavior;
use yii\behaviors\AttributeBehavior;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;

/**
 * This is the model class for table "{{%product}}".
 *
 * @property int $id
 * @property int $tenant_id
 * @property string $sku
 * @property string $title
 * @property string $slug
 * @property string $description
 * @property int $category_id
 * @property int $seller_id
 * @property int $updater_id
 * @property string $thumbnail_base_path
 * @property string $thumbnail_path
 * @property int $start_price
 * @property int $sell_price
 * @property int $quantity_available
 * @property int $quantity_sold
 * @property int $deal_time
 * @property int $condition_id
 * @property int $is_free_shipping
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Category $category
 * @property User $seller
 * @property User $updater
 */
class Product extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%product}}';
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
                'updatedAtAttribute' => 'updated_at',
                'value' => time()
            ],
            'slug' => [
                'class' => SluggableBehavior::className(),
                'attribute' => 'slug',
                'slugAttribute' => 'title',
                'ensureUnique' => true
            ],
            'blameable' => [
                'class' => BlameableBehavior::className(),
                'createdByAttribute' => 'seller_id',
                'updatedByAttribute' => 'updater_id',
            ],
            'sku' => [
                'class' => AttributeBehavior::className(),
                'attributes' => [
                    self::EVENT_BEFORE_INSERT => 'sku'
                ],
                'value' => Yii::$app->getSecurity()->generateRandomString(6)
            ]
        ]);
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'slug', 'category_id', 'sell_price'], 'required'],
            [['category_id', 'seller_id', 'updater_id', 'start_price', 'sell_price', 'quantity_available', 'quantity_sold', 'deal_time', 'condition_id', 'is_free_shipping', 'status', 'created_at', 'updated_at'], 'integer'],
            [['description'], 'string'],
            [['sku'], 'string', 'max' => 10],
            [['title', 'thumbnail_base_path'], 'string', 'max' => 512],
            [['slug', 'thumbnail_path'], 'string', 'max' => 1024],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'id']],
            [['seller_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['seller_id' => 'id']],
            [['updater_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['updater_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('db', 'ID'),
            'tenant_id' => Yii::t('db', 'Tenant ID'),
            'sku' => Yii::t('db', 'Sku'),
            'title' => Yii::t('db', 'Title'),
            'slug' => Yii::t('db', 'Slug'),
            'description' => Yii::t('db', 'Description'),
            'category_id' => Yii::t('db', 'Category ID'),
            'seller_id' => Yii::t('db', 'Seller ID'),
            'updater_id' => Yii::t('db', 'Updater ID'),
            'thumbnail_base_path' => Yii::t('db', 'Thumbnail Base Path'),
            'thumbnail_path' => Yii::t('db', 'Thumbnail Path'),
            'start_price' => Yii::t('db', 'Start Price'),
            'sell_price' => Yii::t('db', 'Sell Price'),
            'quantity_available' => Yii::t('db', 'Quantity Available'),
            'quantity_sold' => Yii::t('db', 'Quantity Sold'),
            'deal_time' => Yii::t('db', 'Deal Time'),
            'condition_id' => Yii::t('db', 'Condition ID'),
            'is_free_shipping' => Yii::t('db', 'Is Free Shipping'),
            'status' => Yii::t('db', 'Status'),
            'created_at' => Yii::t('db', 'Created At'),
            'updated_at' => Yii::t('db', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSeller()
    {
        return $this->hasOne(User::className(), ['id' => 'seller_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUpdater()
    {
        return $this->hasOne(User::className(), ['id' => 'updater_id']);
    }
}
