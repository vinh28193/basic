<?php

namespace app\models\resources;

use Yii;

/**
 * This is the model class for table "{{%image}}".
 *
 * @property int $id
 * @property string $name
 * @property string $base_url
 * @property string $path
 * @property string $type
 * @property int $size
 * @property int $upload_by
 * @property string $upload_ip
 * @property int $status
 * @property int $created_at
 *
 * @property User $uploadBy
 */
class Image extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%image}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['path','name'], 'required'],
            [['size', 'upload_by', 'status', 'created_at'], 'integer'],
            [['name', 'type'], 'string', 'max' => 255],
            [['base_url', 'path'], 'string', 'max' => 1024],
            [['upload_ip'], 'string', 'max' => 15],
            [['upload_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['upload_by' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('db', 'ID'),
            'name' => Yii::t('db', 'Name'),
            'base_path' => Yii::t('db', 'Base Path'),
            'path' => Yii::t('db', 'Path'),
            'type' => Yii::t('db', 'Type'),
            'size' => Yii::t('db', 'Size'),
            'upload_by' => Yii::t('db', 'Upload By'),
            'upload_ip' => Yii::t('db', 'Upload Ip'),
            'status' => Yii::t('db', 'Status'),
            'created_at' => Yii::t('db', 'Created At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUploadBy()
    {
        return $this->hasOne(User::className(), ['id' => 'upload_by']);
    }

    private $_mimeType;
    public function setMimeType($mimeType)
    {
        $this->_mimeType = $mimeType;
    }
    public function getMimeType(){
        if(!$this->_mimeType){
            $this->_mimeType = 'jpg';
        }
        return $this->_mimeType;
    }

    private $_fullPath;
    public function setFullPath($fullPath)
    {
        $this->_fullPath = $fullPath;
    }
    public function getFullPath(){
        if(!$this->_fullPath){
            $this->_fullPath = implode('/', [$this->base_url,$this->path,$this->name]).'.'.$this->mimeType;
        }
        return $this->_fullPath;
    }

}
