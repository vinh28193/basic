<?php

namespace app\models\resources;

use Yii;

/**
 * This is the model class for table "user_auth".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $source_id
 * @property string $source
 *
 * @property User $user
 */
class UserAuth extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_auth';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'source_id', 'source'], 'required'],
            [['user_id'], 'integer'],
            [['source_id'], 'string', 'max' => 32],
            [['source'], 'string', 'max' => 100],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'source_id' => Yii::t('app', 'Source ID'),
            'source' => Yii::t('app', 'Source'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
