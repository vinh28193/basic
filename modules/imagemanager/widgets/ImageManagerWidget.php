<?php 

namespace app\modules\imagemanager\widgets;

use Yii;
use Closure;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\base\Widget;
use yii\base\InvalidConfigException;

class ImageManagerWidget extends Widget
{
 	public $options = [];
   
    public $dataProvider;
    public $showOnEmpty = false;
    public $emptyText;
    public $emptyTextOptions = ['class' => 'empty'];
    public $itemOptions = [];
    public $itemView;
    public $viewParams = [];
    public $cropImageOption = [
    	'id' => 'image-cropper'
    ];
    public $cropActionsButtons = [
		'apply-crop' => [
			'tag' => 'a',
			'label' => 'Crop',
			'icon' => 'fa fa-crop',
			'options' => [
				'class' => 'btn btn-primary'
    		],
    		'active' => true
    	],
    	'apply-crop-select' => [
			'tag' => 'a',
			'label' => 'Crop',
			'icon' => 'fa fa-crop',
			'options' => [
				'class' => 'btn btn-primary'
    		],
    		'active' => true
    	],
    	'apply-crop' => [
			'tag' => 'a',
			'label' => 'Cancel',
			'icon' => 'fa fa-undo',
			'options' => [
				'class' => 'btn btn-default'
    		],
    		'active' => true
    	],
    ];
  
    public $editorOptions = ['class' => 'col-xs-6 col-sm-10 col-image-editor'];
    public $overviewOptions = ['class' => 'col-xs-6 col-sm-10 col-overview'];
    public $toolbarOptions = ['class' => 'col-xs-6 col-sm-2 col-options'];
    public $layout =<<<HTML
    	<div class="row">
        	{editor}
        	{overview}
        	{toolbars}
        </div>
HTML;
	public $editorLayout =<<<HTML
		<div class="image-cropper">
            <div class="image-wrapper">
                {cropImage}
            </div>
            <div class="action-buttons">
                {cropActions}
            </div>
        </div> 
HTML;
	public $overviewLayout = '{items}';
	public $toolbarsLayout = <<<HTML
		{search}
        {uploadFile}
        <div class="image-info hide">
            <div class="thumbnail">
                {thumbnail}
            </div>
            <div class="edit-buttons">
                {CropBtn}
            </div>
            <div class="details">
                {detail}
            </div>
        </div>
HTML;

	/**
     * Initializes the view.
     */
    public function init()
    {
        parent::init();
        if ($this->dataProvider === null) {
            throw new InvalidConfigException('The "dataProvider" property must be set.');
        }
        if ($this->emptyText === null) {
            $this->emptyText = Yii::t('yii', 'No results found.');
        }
        if (!isset($this->options['id'])) {
            $this->options['id'] = $this->getId();
        }
    }

    /**
     * Runs the widget.
     */
    public function run()
    {
      
        $content = preg_replace_callback('/{\\w+}/', function ($matches) {
            $content = $this->renderSection($matches[0]);
            return $content === false ? $matches[0] : $content;
        }, $this->layout);
        
        $options = $this->options;
        $tag = ArrayHelper::remove($options, 'tag', 'div');
        echo Html::tag($tag, $content, $options);
    }
    /**
     * Renders a section of the specified name.
     * If the named section is not supported, false will be returned.
     * @param string $name the section name, e.g., `{editor}`, `{overview}`.
     * @return string|bool the rendering result of the section, or false if the named section is not supported.
     */
    public function renderSection($name)
    {
        switch ($name) {
            case '{editor}':
                return $this->renderLayout($this->editorLayout,$this->editorOptions);
            case '{overview}':
                return $this->renderLayout($this->overviewLayout,$this->overviewOptions);
            case '{toolbars}':
                return $this->renderLayout($this->toolbarsLayout,$this->toolbarOptions);
            case '{cropImage}':
                return $this->renderImageCrop();
            case '{cropActions}':
                return $this->renderActionCrop();
            case 'items':
            	return $this->renderEmpty();
            case '{search}':
            	return $this->renderEmpty();
            case '{uploadFile}':
            	return $this->renderEmpty();
            case '{thumbnail}':
            	return $this->renderEmpty();
            case '{CropBtn}':
            	return $this->renderEmpty();
            case '{detail}':
            	return $this->renderEmpty();	
            default:
                return false;
        }
    }

    /**
     * Renders the HTML content indicating that the list view has no data.
     * @return string the rendering result
     * @see emptyText
     */
    public function renderEmpty()
    {
        if ($this->emptyText === false) {
            return '';
        }
        $options = $this->emptyTextOptions;
        $tag = ArrayHelper::remove($options, 'tag', 'div');
        return Html::tag($tag, $this->emptyText, $options);
    }

    public function renderLayout($layout,$options)
    {
		$content = preg_replace_callback('/{\\w+}/', function ($matches) {
            $content = $this->renderSection($matches[0]);

            return $content === false ? $matches[0] : $content;
        }, $layout);

        $tag = ArrayHelper::remove($options, 'tag', 'div');
    	return Html::tag($tag, $content, $options);
    }
    public function renderImageCrop()
    {
    	return Html::img(null,$this->cropImageOption);
    }
    public function renderActionCrop()
    {
    	$buttons = $this->cropActionsButtons;
    	if(count($buttons) = 0){
    		$this->renderEmpty();
    	}
    	return $this->renderEmpty();
    }
}
 ?>
