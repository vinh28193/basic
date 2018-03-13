<?php

namespace app\modules\mediamanager;

/**
 * mediamanager module definition class
 */
class MediaManager  extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'app\modules\mediamanager\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        $this->defaultRoute = 'default/index';
        //$this->layout = 'main';
        $this->setAliases(['@mediamanager' => __DIR__]);
        $this->setLayoutPath('@mediamanager/layouts');
        // custom initialization code goes here
    }
}
