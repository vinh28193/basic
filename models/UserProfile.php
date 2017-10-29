<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii\behaviors\AttributeBehavior;
use yii\behaviors\TimestampBehavior;
use app\common\db\ActiveRecord;

/**
 * This is the model class for table "{{%user_profile}}".
 *
 * @property integer $user_id
 * @property string $first_name
 * @property string $last_name
 * @property string $avatar_path
 * @property string $avatar_base_url
 * @property string $identity_code
 * @property string $birthday
 * @property string $address
 * @property string $bio
 * @property string $locale
 * @property integer $gender
 * @property integer $updated_at
 *
 * @property User $user
 *
 * @property null|string $fullName
 * @property null|string $avatar
 */
class UserProfile extends ActiveRecord
{
    const SCENARIO_INIT = 'initialize';
    const SCENARIO_COMPLETE = 'complete';

    const GENDER_FEMALE = 0;
    const GENDER_MALE = 1;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user_profile}}';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return ArrayHelper::merge(parent::behaviors(), [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => false,
                'updatedAtAttribute' => 'updated_at',
            ],
            'locale' => [
                'class' => AttributeBehavior::className(),
                'attributes' => [
                    self::EVENT_BEFORE_INSERT => 'locale',
                    self::EVENT_AFTER_UPDATE => 'locale'
                ],
                'value' => Yii::$app->language
            ],
        ]);
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        return ArrayHelper::merge(parent::scenarios(), [
            self::SCENARIO_INIT => ['user_id', 'first_name', 'last_name'],
            self::SCENARIO_COMPLETE => ['user_id','first_name','last_name','birthday','phone','address'],
        ]);
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'first_name', 'last_name'], 'required', 'on' => self::SCENARIO_INIT],
            [['user_id', 'first_name', 'last_name','birthday','phone','address'], 'required', 'on' => self::SCENARIO_COMPLETE],
            [['user_id', 'gender', 'updated_at'], 'integer'],
            [['bio'], 'string'],
            [['first_name', 'last_name', 'address'], 'string', 'max' => 100],
            [['avatar_path', 'avatar_base_url'], 'string', 'max' => 255],
            [['identity_code'], 'string', 'max' => 15],
            [['birthday'], 'string', 'max' => 12],
            [['locale'], 'string', 'max' => 32],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['avatar'],'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => Yii::t('app', 'User ID'),
            'first_name' => Yii::t('app', 'First Name'),
            'last_name' => Yii::t('app', 'Last Name'),
            'avatar_path' => Yii::t('app', 'Avatar Path'),
            'avatar_base_url' => Yii::t('app', 'Avatar Base Url'),
            'identity_code' => Yii::t('app', 'Identity Code'),
            'birthday' => Yii::t('app', 'Birthday'),
            'address' => Yii::t('app', 'Address'),
            'bio' => Yii::t('app', 'Bio'),
            'locale' => Yii::t('app', 'Locale'),
            'gender' => Yii::t('app', 'Gender'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    private $_fullName = null;

    public function setFullName($fullName){
            $this->_fullName = $fullName;
            // list($first_name,$last_name) = explode(' ',$this->_fullName);
            // $this->first_name = $first_name;
            // $this->last_name = $last_name;
    }
    /**
     * @return null|string
     */
    public function getFullName()
    {
        if ($this->first_name || $this->last_name) {
            $this->_fullName = implode(' ', [$this->first_name, $this->last_name]);
        }
        return $this->_fullName;
    }

    private $_avatar = null;

    public function setAvatar($avatarPath){
            $this->_avatar = $avatarPath;
            // $this->avatar_path = $this->_avatar
    }
    /**
     * @return null|string
     */
    public function getAvatar()
    {
        if($this->avatar_path){
            $this->_avatar = Yii::getAlias($this->avatar_base_url . '/' . $this->avatar_path);
        }
        return $this->_avatar;
    }
    
    /**
     * @return null|string
     */
    public function uploadAvatar(){
        
    }
}
