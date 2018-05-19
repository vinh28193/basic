<?php

namespace app\models\resources;

use Yii;

/**
 * This is the model class for table "{{%variant_value}}".
 *
 * @property int $id
 * @property int $tenant_id
 * @property string $value
 * @property int $visible
 * @property int $created_at
 * @property int $updated_at
 *
 * @property VariantValueItem[] $variantValueItems
 */
class VariantValue extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%variant_value}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tenant_id', 'value'], 'required'],
            [['tenant_id', 'visible', 'created_at', 'updated_at'], 'integer'],
            [['value'], 'string', 'max' => 64],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tenant_id' => 'Tenant ID',
            'value' => 'Value',
            'visible' => 'Visible',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVariantValueItems()
    {
        return $this->hasMany(VariantValueItem::className(), ['variant_value_id' => 'id']);
    }
}
