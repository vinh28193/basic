<?php

namespace app\modules\api;

use yii\base\Module;
/**
 * api module definition class
 */
class Service extends Module
{
    /**
     * @var string protocol version.
     */
    public $version = '1.0';

    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'app\modules\api\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
}
