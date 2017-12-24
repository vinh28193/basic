<?php

namespace app\models\resources;

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
use yii\web\IdentityInterface;
use yii\behaviors\AttributeBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%user}}".
 *
 * @property integer $id
 * @property string $username
 * @property string $email
 * @property string $phone
 * @property string $oauth_id
 * @property string $oauth_secret
 * @property string $access_token
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property integer $status
 * @property integer $created_at
 * @property integer $verified_at
 *
 * @property UserProfile $userProfile
 * @property UserAuth[] $userAuths
 * @property UserLog[] $userLogs

 * @property string publicIdentity
 * @property string avatarPath
 * @property string myRole
 */
class User extends ActiveRecord
{

    const ACCESS_GRANTED = 1;
    const ACCESS_DENIED = 0;
    const ACCESS_GUESTED = 10;

    const SCENARIO_GUEST = 'guest';
    const SCENARIO_OAUTH_1 = 'oauth1';
    const SCENARIO_OAUTH_2 = 'oauth2';
    const SCENARIO_REGISTER = 'register';

    const TIME_EXPIRE = 3600 * 24 * 30;
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
    public function behaviors()
    {
        return ArrayHelper::merge(parent::behaviors(), [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => false,
                'value' => time()
            ],
            'status' => [
                'class' => AttributeBehavior::className(),
                'attributes' => [
                    self::EVENT_BEFORE_INSERT => 'status',
                ],
                'value' => self::ACCESS_GUESTED
            ],
            'auth_key' => [
                'class' => AttributeBehavior::className(),
                'attributes' => [
                    self::EVENT_BEFORE_INSERT => 'auth_key'
                ],
                'value' => Yii::$app->getSecurity()->generateRandomString(32)
            ],
            'access_token' => [
                'class' => AttributeBehavior::className(),
                'attributes' => [
                    self::EVENT_BEFORE_INSERT => 'access_token'
                ],
                'value' => function () {
                    return Yii::$app->getSecurity()->generateRandomString(40);
                }
            ]
        ]);
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        return ArrayHelper::merge(parent::scenarios(), [
            self::SCENARIO_REGISTER => ['username', 'password_hash', 'email','phone'],
            self::SCENARIO_GUEST => 'email',
        ]);
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'password_hash', 'email'], 'required', 'on' => self::SCENARIO_REGISTER],
            [['username', 'email'], 'unique'],
            [['status', 'created_at', 'verified_at'], 'integer'],
            [['username', 'auth_key'], 'string', 'max' => 32],
            [['email', 'password_hash'], 'string', 'max' => 255],
            [['phone'], 'string', 'max' => 15],
            ['access_token', 'string', 'max' => 40],
            ['username', 'filter', 'filter' => '\yii\helpers\Html::encode'],
            ['email', 'email'],
            ['email', 'required', 'on' => self::SCENARIO_GUEST],
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
            'phone' => Yii::t('app', 'Phone'),
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
     * @return \yii\db\ActiveQuery
     */
    public function getUserProfile()
    {
        return $this->hasOne(UserProfile::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserAuths()
    {
        //return $this->hasMany(UserAuth::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserLogs()
    {
        //return $this->hasMany(UserLog::className(), ['user_id' => 'id']);
    }

    /**
     * Validates password
     *
     * @param  string $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePasswordHash($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * @return string
     */
    public function getMyRole(){
        return 'administrator';
    }

    /**
     * @return mixed|string
     */
    public function getPublicIdentity(){
        if ($this->userProfile && $this->userProfile->fullName) {
            return $this->userProfile->fullName;
        }
        if ($this->username) {
            return $this->username;
        }
        return $this->email;
    }

    /**
     * @return mixed|string
     */
    public function getAvatarPath(){
        if ($this->userProfile && $this->userProfile->avatar) {
            return $this->userProfile->avatar;
        }
        return '/no-image.jpg';
    }
}
