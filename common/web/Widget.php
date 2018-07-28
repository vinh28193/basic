<?php
/**
 * Created by PhpStorm.
 * User: vinhs
 * Date: 2018-07-28
 * Time: 23:08
 */

namespace app\common\web;

use Yii;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;

class Widget extends \yii\bootstrap\Widget
{

    /**
     * Js moduleId namespace
     * @var string
     */
    public $jsModuleId;

    /**
     * Creates a widget instance and runs it.
     *
     * The widget rendering result is returned by this method.
     * @param array $config name-value pairs that will be used to initialize the object properties
     * @return string the rendering result of the widget.
     * @throws \Exception
     */

    /**
     * Event action handler.
     * @var array
     */
    public $events = [];

    /**
     * Auto init flag.
     * @var mixed
     */
    public $init = false;

    /**
     * Used to hide/show the actual input element.
     * @var boolean
     */
    public $visible = true;


    /**
     * If set to true or 'fast', 'slow' or a integer duration in milliseconds the jsWidget will fade in the root element after initialization.
     * This can be handy for widgets which need some time to initialize.
     *
     * @var bool|string|integer
     * @since 1.2.2
     */
    public $fadeIn = false;

    /**
     * Assembles all widget attributes and data settings of this widget.
     * Those attributes/options are are normally transfered to the js client by ordinary html attributes
     * or by using data-* attributes.
     *
     * @return array
     */
    protected function getOptions()
    {
        $attributes = $this->getAttributes();
        $attributes['data'] = $this->getData();
        $attributes['id'] = $this->getId();

        $this->setDefaultOptions();

        $result = ArrayHelper::merge($attributes, $this->options);

        if (!$this->visible) {
            Html::addCssStyle($result, 'display:none');
        }

        return $result;
    }

    /**
     * Sets some default data options required by all widgets as the widget implementation
     * and the widget evetns and initialization trigger.
     */
    public function setDefaultOptions()
    {
        // Set event data
        foreach ($this->events as $event => $handler) {
            $this->options['data']['application-action-' . $event] = $handler;
        }

        if($this->jsModuleId) {
            $this->options['data']['application-widget'] = $this->jsModuleId;
        }

        if (!empty($this->init)) {
            $this->options['data']['application-init'] = $this->init;
        }
    }

    /**
     * Returns the html id of this widget, if no id is set this function will generate
     * an id if $autoGenerate is set to true (default).
     *
     * Note that the id is automatically included within the <code>getOptions()<code> function.
     *
     * @param bool $autoGenerate
     * @return string
     */
    public function getId($autoGenerate = true)
    {
        if ($this->id) {
            return $this->id;
        }

        return $this->id = parent::getId($autoGenerate);
    }

    /**
     * Returns an array of data-* attributes to configure your clientside js widget.
     * Note that this function does not require to add the data- prefix. This will be done by Yii.
     *
     * The data-* attributes should be inserted to the widgets root element.
     * @return array
     */
    protected function getData()
    {
        return [];
    }

    /**
     * Returns all html attributes for used by this widget and will normally inserted in the widgets root html element.
     * @return array
     */
    protected function getAttributes()
    {
        return [];
    }

}