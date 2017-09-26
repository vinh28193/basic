<?php
namespace app\common\db;

use Yii;
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
        return Yii::createObject(ActiveQuery::className(), [get_called_class()]);
    }
}

?>