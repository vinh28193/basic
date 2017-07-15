<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii\web\IdentityInterface;
use yii\behaviors\AttributeBehavior;
use yii\behaviors\TimestampBehavior;
use yii\filters\RateLimitInterface;
use app\common\db\ActiveRecord;

/**
 * This is the model class for table "{{%user}}".
 *
 * @property integer $id
 * @property string $username
 * @property string $email
 * @property string $access_token
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property integer $status
 * @property integer $created_at
 * @property integer $verified_at
 *
 * @property UserProfile $userProfile
 */
class User extends ActiveRecord implements IdentityInterface
{

    const ACCESS_GRANTED = 1;
    const ACCESS_DENIED = 0;
    const ACCESS_GUESTED = 10;

    const SCENARIO_GUEST = 'guest';

    const TIME_EXPIRE = 3600*24*30;
    const GUEST_EXPIRE = 3600;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
             [['username','password_hash','email'],'required'],
            [['username', 'email'], 'unique'],
            [['type', 'status', 'created_at', 'verified_at'], 'integer'],
            [['username', 'auth_key'], 'string', 'max' => 32],
            [['email', 'password_hash'], 'string', 'max' => 255],
            ['access_token', 'string', 'max' => 40],
            ['username','filter','filter'=>'\yii\helpers\Html::encode'],
            ['email','email'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'username' => Yii::t('app', 'Username'),
            'email' => Yii::t('app', 'Email'),
            'access_token' => Yii::t('app', 'Access Token'),
            'auth_key' => Yii::t('app', 'Auth Key'),
            'password_hash' => Yii::t('app', 'Password Hash'),
            'password_reset_token' => Yii::t('app', 'Password Reset Token'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'verified_at' => Yii::t('app', 'Verified At'),
        ];
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne([
            'id' => $id, 
        ]);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return null;
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $auth_key;
    }

    /**
     * Validates password
     *
     * @param  string  $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePasswordHash($password)
    {
         return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Finds user by username or email 
     *
     * @param string $value
     * @return static|null
     */
    public static function findAdvanced($value)
    {

        return static::find()->where([
            'and',
            [
                'or',
                ['username' => $value],
                ['email' => $value],
            ],
            ['status' => self::ACCESS_GRANTED]
        ])->one();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserProfile()
    {
        return $this->hasOne(UserProfile::className(), ['user_id' => 'id']);
    }
}
