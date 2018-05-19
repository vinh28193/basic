<?php

namespace app\models\resources;

use Yii;

/**
 * This is the model class for table "{{%variant}}".
 *
 * @property int $id
 * @property int $tenant_id
 * @property string $name
 * @property string $alias
 * @property int $visible
 * @property int $created_at
 * @property int $updated_at
 *
 * @property VariantValueItem[] $variantValueItems
 */
class Variant extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%variant}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tenant_id', 'name', 'alias'], 'required'],
            [['tenant_id', 'visible', 'created_at', 'updated_at'], 'integer'],
            [['name'], 'string', 'max' => 32],
            [['alias'], 'string', 'max' => 64],
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
            'name' => 'Name',
            'alias' => 'Alias',
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
        return $this->hasMany(VariantValueItem::className(), ['variant_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVariantValue()
    {
        return $this->hasMany(VariantValue::className(), ['id' => 'variant_value_id'])->via('variantValueItems');
    }
}
