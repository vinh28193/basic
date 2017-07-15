<?php
namespace app\common\db;

use Yii;
use yii\helpers\ArrayHelper;
use yii\behaviors\SluggableBehavior;
use yii\behaviors\TimestampBehavior;
/**
 *
 */
class ActiveRecord extends \yii\db\ActiveRecord
{

    /**
     * @inheritdoc
     * @return \app\common\db\ActiveQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ActiveQuery(get_called_class());
    }
}

?>