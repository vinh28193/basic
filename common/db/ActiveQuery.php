<?php
namespace app\common\db;
/**
 *
 */
class ActiveQuery extends \yii\db\ActiveQuery
{
	 /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return app\common\db\ActiveRecord[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }
	 /**
     * @inheritdoc
     * @return  app\common\db\ActiveRecord|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}

?>