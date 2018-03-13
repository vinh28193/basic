<?php

namespace app\modules\mediamanage;

/**
 * mediamanage module definition class
 */
class MediaManage  extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'app\modules\mediamanage\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        $this->defaultRoute = 'default/index';
        //$this->layout = 'main';
        $this->setAliases(['@mediamanage' => __DIR__]);
        $this->setLayoutPath('@mediamanage/layouts');
        // custom initialization code goes here
    }
}
