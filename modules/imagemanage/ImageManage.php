<?php

namespace app\modules\imagemanage;

/**
 * imagemanage module definition class
 */
class ImageManage  extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'app\modules\imagemanage\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        $this->defaultRoute = 'default/index';
        $this->layout = 'main';
        $this->setAliases(['@imagemanage' => __DIR__]);
        $this->setLayoutPath('@imagemanage/layouts');
        // custom initialization code goes here
    }
}
