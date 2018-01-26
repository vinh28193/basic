<?php

namespace app\modules\filemanage;

/**
 * filemanager module definition class
 */
class Filemanager extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'app\modules\filemanage\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        $this->defaultRoute = 'default/index';
        $this->layout = 'main';
        $this->setAliases(['@filemanage' => __DIR__]);
        $this->setLayoutPath('@filemanage/layouts');
        // custom initialization code goes here
    }
}
