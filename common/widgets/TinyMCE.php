<?php

namespace app\common\widgets;

use Yii;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\web\JsExpression;
use dosamigos\tinymce\TinyMce as BaseTinyMCE;
use dosamigos\tinymce\TinyMceAsset;
use dosamigos\tinymce\TinyMceLangAsset;
/**
 * TinyMCE renders a tinyMCE js plugin for WYSIWYG editing.
 *
 * To use this widget, you may insert the following code in a view:
 *
 * ```php
 *
 * use app\common\widgets\TinyMCE;
 *
 * echo $form->field($model, 'text')->widget(TinyMCE::className(), [
 *    'options' => ['rows' => 6],
 * ]);
 *
 * ```
 */
class TinyMCE extends BaseTinyMCE
{
	/**
     * @inheritdoc
     */
	public function init(){
		parent::init();
		$this->clientOptions = ArrayHelper::merge([
			'plugins' => 'print preview fullpage searchreplace autolink directionality visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists textcolor wordcount imagetools help',
			'toolbar1' => 'formatselect | bold italic strikethrough forecolor backcolor | link | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent  | removeformat',
			'image_title' => true,
			'content_css' => [
				'//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
		    	'//www.tinymce.com/css/codepen.min.css'
			],
			// 'external_filemanager_path' => Url::to(['/mediamanage/default/index'],true),
			// 'external_plugins' => [
			// 	'filemanager' => Yii::getAlias('@web/js/yii.mediaPluginToMce.js')
			// ]
		],$this->clientOptions);
	}
	/**
     * @inheritdoc
     */
    public function run()
    {
        if ($this->hasModel()) {
            echo Html::activeTextarea($this->model, $this->attribute, $this->options);
        } else {
            echo Html::textarea($this->name, $this->value, $this->options);
        }
        $this->registerClientScript();
    }

    /**
     * Registers tinyMCE js plugin
     */
    protected function registerClientScript()
    {
        $js = [];
        $view = $this->getView();

        TinyMceAsset::register($view);

        $id = $this->options['id'];

        $this->clientOptions['selector'] = "#$id";
        // @codeCoverageIgnoreStart
        if ($this->language !== null && $this->language !== 'en') {
            $langFile = "langs/{$this->language}.js";
            $langAssetBundle = TinyMceLangAsset::register($view);
            $langAssetBundle->js[] = $langFile;
            $this->clientOptions['language_url'] = $langAssetBundle->baseUrl . "/{$langFile}";
        }
        // @codeCoverageIgnoreEnd

        $options = Json::encode($this->clientOptions);

        $js[] = "tinymce.init($options);";
        if ($this->triggerSaveOnBeforeValidateForm) {
            $js[] = "$('#{$id}').parents('form').on('beforeValidate', function() { tinymce.triggerSave(); });";
        }
        $view->registerJs(implode("\n", $js));
    }

}