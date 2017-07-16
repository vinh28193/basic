<?php 
namespace app\common\web;

use Yii;
use yii\db\Query;
use yii\di\Instance;
use yii\db\Connection;
use yii\base\InvalidConfigException;

/**
 * Model is the base class for data models.
 * For more details and usage information on Model, see the [guide article on models](guide:structure-models).
 */
class Model extends \yii\base\Model
{
	/**
     * @event Event an event that is triggered when the record is initialized via [[init()]].
     */
    const EVENT_INIT = 'init';

	 /**
     * @var string the application component ID of the connection object.
     * After the Model object is created, if you want to change this property, you should only assign it
     * with a application component ID of the connection object.
     */
    public $connection = 'db';

	/**
     * Initializes the object.
     * This method is called at the end of the constructor.
     * The default implementation will trigger an [[EVENT_INIT]] event.
     * If you override this method, make sure you call the parent implementation at the end
     * to ensure triggering of the event.
     */
    public function init()
    {
        parent::init();
        if(Yii::$app->has($this->connection)){
            $this->connection = Yii::$app->get($this->connection);
        }
        $this->trigger(self::EVENT_INIT);
    }
}