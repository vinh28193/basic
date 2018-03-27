<?php

namespace app\models\resources;

use Yii;

/**
 * This is the model class for table "{{%tenant}}".
 *
 * @property int $tenant_id
 * @property string $tenant_code
 * @property string $tenant_name
 * @property string $tenant_name_short
 * @property string $language_code
 * @property string $run_mode
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Article[] $articles
 * @property ArticleCategory[] $articleCategories
 * @property Category[] $categories
 * @property Media[] $media
 * @property Product[] $products
 * @property User[] $users
 * @property UserAuth[] $userAuths
 * @property UserLog[] $userLogs
 * @property UserProfile[] $userProfiles
 */
class Tenant extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%tenant}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tenant_code', 'tenant_name', 'tenant_name_short', 'language_code', 'run_mode'], 'required'],
            [['created_at', 'updated_at'], 'integer'],
            [['tenant_code'], 'string', 'max' => 512],
            [['tenant_name', 'tenant_name_short', 'language_code', 'run_mode'], 'string', 'max' => 12],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'tenant_id' => Yii::t('db', 'Tenant ID'),
            'tenant_code' => Yii::t('db', 'Tenant Code'),
            'tenant_name' => Yii::t('db', 'Tenant Name'),
            'tenant_name_short' => Yii::t('db', 'Tenant Name Short'),
            'language_code' => Yii::t('db', 'Language Code'),
            'run_mode' => Yii::t('db', 'Run Mode'),
            'created_at' => Yii::t('db', 'Created At'),
            'updated_at' => Yii::t('db', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getArticles()
    {
        return $this->hasMany(Article::className(), ['tenant_id' => 'tenant_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getArticleCategories()
    {
        return $this->hasMany(ArticleCategory::className(), ['tenant_id' => 'tenant_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategories()
    {
        return $this->hasMany(Category::className(), ['tenant_id' => 'tenant_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMedia()
    {
        return $this->hasMany(Media::className(), ['tenant_id' => 'tenant_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['tenant_id' => 'tenant_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['tenant_id' => 'tenant_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserAuths()
    {
        return $this->hasMany(UserAuth::className(), ['tenant_id' => 'tenant_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserLogs()
    {
        return $this->hasMany(UserLog::className(), ['tenant_id' => 'tenant_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserProfiles()
    {
        return $this->hasMany(UserProfile::className(), ['tenant_id' => 'tenant_id']);
    }
}
