<?php

namespace app\models\resources;

use Yii;

/**
 * This is the model class for table "{{%variant_value_item}}".
 *
 * @property int $id
 * @property int $tenant_id
 * @property int $variant_id
 * @property int $variant_value_id
 * @property int $created_at
 *
 * @property ProductVariant[] $productVariants
 * @property Variant $variant
 * @property VariantValue $variantValue
 */
class VariantValueItem extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%variant_value_item}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tenant_id', 'variant_id', 'variant_value_id'], 'required'],
            [['tenant_id', 'variant_id', 'variant_value_id', 'created_at'], 'integer'],
            [['variant_id'], 'exist', 'skipOnError' => true, 'targetClass' => Variant::className(), 'targetAttribute' => ['variant_id' => 'id']],
            [['variant_value_id'], 'exist', 'skipOnError' => true, 'targetClass' => VariantValue::className(), 'targetAttribute' => ['variant_value_id' => 'id']],
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
            'variant_id' => 'Variant ID',
            'variant_value_id' => 'Variant Value ID',
            'created_at' => 'Created At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductVariants()
    {
        return $this->hasMany(ProductVariant::className(), ['variant_value_item_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVariant()
    {
        return $this->hasOne(Variant::className(), ['id' => 'variant_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVariantValue()
    {
        return $this->hasOne(VariantValue::className(), ['id' => 'variant_value_id']);
    }
}
