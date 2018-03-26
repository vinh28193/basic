<?php

namespace app\models\resources;

use Yii;

/**
 * This is the model class for table "{{%product}}".
 *
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property string $description
 * @property int $category_id
 * @property int $creator_id
 * @property int $updater_id
 * @property int $price
 * @property int $quantity
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Category $category
 * @property User $creator
 * @property User $updater
 */
class Product extends \yii\db\ActiveRecord
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
    public function rules()
    {
        return [
            [['title', 'slug', 'category_id', 'price'], 'required'],
            [['description'], 'string'],
            [['category_id', 'creator_id', 'updater_id', 'price', 'quantity', 'status', 'created_at', 'updated_at'], 'integer'],
            [['title'], 'string', 'max' => 512],
            [['slug'], 'string', 'max' => 1024],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'id']],
            [['creator_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['creator_id' => 'id']],
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
            'title' => Yii::t('db', 'Title'),
            'slug' => Yii::t('db', 'Slug'),
            'description' => Yii::t('db', 'Description'),
            'category_id' => Yii::t('db', 'Category ID'),
            'creator_id' => Yii::t('db', 'Creator ID'),
            'updater_id' => Yii::t('db', 'Updater ID'),
            'price' => Yii::t('db', 'Price'),
            'quantity' => Yii::t('db', 'Quantity'),
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
    public function getCreator()
    {
        return $this->hasOne(User::className(), ['id' => 'creator_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUpdater()
    {
        return $this->hasOne(User::className(), ['id' => 'updater_id']);
    }
}
