<?php

namespace app\modules\imagemanager;

/**
 * imagemanage module definition class
 */
class ImageManage  extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'app\modules\imagemanager\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        $this->defaultRoute = 'default/index';
        $this->layout = 'main';
        $this->setAliases(['@imagemanager' => __DIR__]);
        $this->setLayoutPath('@imagemanager/layouts');
        // custom initialization code goes here
    }
}
