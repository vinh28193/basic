<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\modules\mediamanage\widgets;

use Closure;
use Yii;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\helpers\Url;
use yii\i18n\Formatter;
use yii\widgets\BaseListView;
use yii\base\InvalidConfigException;
use app\modules\mediamanage\assets\MediaManageAsset;

class MediaManageWidget extends BaseListView
{

    /**
     * @var array the HTML attributes for the container tag.
     * The "tag" element specifies the tag name of the container element and defaults to "div".
     * @see \yii\helpers\Html::renderTagAttributes() for details on how attributes are being rendered.
     */
    public $options = ['class' => 'container-fluid'];

    /**
     * @var array the HTML attributes for the container tag.
     * The "tag" element specifies the tag name of the container element and defaults to "div".
     * @see \yii\helpers\Html::renderTagAttributes() for details on how attributes are being rendered.
     */
    public $itemsOptions = ['class' => 'row items'];
    /**
     * @var \yii\base\Model the model that keeps the user-entered filter data. When this property is set,
     * the grid view will enable column-based filtering. Each data column by default will display a text field
     * at the top that users can fill in to filter the data.
     *
     * When this property is not set (null) the filtering feature is disabled.
     */
    public $filterModel;
    /**
     * @var string|array the URL for returning the filtering result. [[Url::to()]] will be called to
     * normalize the URL. If not set, the current controller action will be used.
     * When the user makes change to any filter input, the current filtering inputs will be appended
     * as GET parameters to this URL.
     */
    public $filterUrl;
    /**
     * @var string additional jQuery selector for selecting filter input fields
     */
    public $filterSelector;
    /**
     * @var array the HTML attributes for the filter row element.
     * @see \yii\helpers\Html::renderTagAttributes() for details on how attributes are being rendered.
     */
    public $filterOptions = ['class' => 'row filters'];

    public $mediaToggle = 'MEDIA';
    public $mediaOptions = ['class' => 'thumbnail col-xs-3 col-md-2'];



    /**
     * @var string the layout that determines how different sections of the grid view should be organized.
     * The following tokens will be replaced with the corresponding section contents:
     *
     * - `{summary}`: the summary section. See [[renderSummary()]].
     * - `{errors}`: the filter model error summary. See [[renderErrors()]].
     * - `{items}`: the list items. See [[renderItems()]].
     * - `{sorter}`: the sorter. See [[renderSorter()]].
     * - `{pager}`: the pager. See [[renderPager()]].
     */
    public $layout = "{filters}\n{summary}\n{items}\n{pager}";


    /**
     * Initializes the grid view.
     * This method will initialize required property values and instantiate [[columns]] objects.
     */
    public function init()
    {
        parent::init();
        if (!isset($this->filterOptions['id'])) {
            $this->filterOptions['id'] = $this->options['id'] . '-filters';
        }
        if (!isset($this->itemsOptions['id'])) {
            $this->itemsOptions['id'] = $this->options['id'] . '-items';
        }
        $this->mediaToggle = $this->mediaToggle .'_'.hash('crc32', $this->options['id']);
    }

    /**
     * Runs the widget.
     */
    public function run()
    {
        $id = $this->options['id'];
        $options = Json::htmlEncode($this->getClientOptions());
        $view = $this->getView();
        MediaManageAsset::register($view);
        $view->registerJs("jQuery('#$id').yiiMediaManage($options);");
        $view->registerJs("jQuery('#$id').on('selectedMedia',function(event){ 
            var src = jQuery('#$id').yiiMediaManage('getSelection')
            console.log(src) ; 
        });");
        parent::run();
    }

    /**
     * Renders validator errors of filter model.
     * @return string the rendering result.
     */
    public function renderFilters()
    {
        $filter = $this->render('filter');
        return Html::tag('div',$filter,$this->filterOptions);
    }

    /**
     * @inheritdoc
     */
    public function renderSection($name)
    {
        switch ($name) {
            case '{filters}':
                return $this->renderFilters();
            default:
                return parent::renderSection($name);
        }
    }

    /**
     * Returns the options for the grid view JS widget.
     * @return array the options
     */
    protected function getClientOptions()
    {
        $filterUrl = isset($this->filterUrl) ? $this->filterUrl : Yii::$app->request->url;
        $id = $this->filterOptions['id'];
        $filterSelector = "#$id input, #$id select";
        if (isset($this->filterSelector)) {
            $filterSelector .= ', ' . $this->filterSelector;
        }

        return [
            'filterUrl' => Url::to($filterUrl),
            'filterSelector' => $filterSelector,
            'mediaSelector' => 'a[data-toggle='.$this->mediaToggle.']'
        ];
    }

    /**
     * Renders the data models for the grid view.
     */
    public function renderItems()
    {
        $models = array_values($this->dataProvider->getModels());
        $keys = $this->dataProvider->getKeys();
        $rows = [];
        foreach ($models as $index => $model) {
            $key = $keys[$index];

            $rows[] = $this->renderMedia($model, $key, $index);

        }

        return Html::tag('div',implode("\n", $rows),$this->itemsOptions);
    }

    public function renderMedia($model, $key, $index)
    {
        $media = $this->render('item',['model' => $model]);
        if ($this->mediaOptions instanceof Closure) {
            $options = call_user_func($this->mediaOptions, $model, $key, $index, $this);
        } else {
            $options = $this->mediaOptions;
        }
        $options['data-toggle'] = $this->mediaToggle;
        $options['data-key'] = is_array($key) ? json_encode($key) : (string) $key;
        return Html::a($media,'#',$options);
    }

}
