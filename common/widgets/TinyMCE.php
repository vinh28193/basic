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
			'plugins' => [
                'advlist autolink link image lists charmap print preview hr anchor pagebreak',
                'searchreplace wordcount visualblocks visualchars insertdatetime media nonbreaking',
                'table contextmenu directionality emoticons paste textcolor code'
            ],
            'toolbar1' => 'undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | styleselect',
            'toolbar2' => '| link unlink anchor | image media | forecolor backcolor  | print preview code ',
            'image_advtab' => true,
            'content_css' => [
                '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
                '//www.tinymce.com/css/codepen.min.css'
            ],
            'filemanager_crossdomain' => true,
            'filemanager_title' => 'Media Manage',
            'external_filemanager_path' => Url::to('http://responsive-filemanager.beta.vn/'),
            'external_plugins' => [
                'filemanager' =>  Yii::getAlias('http://responsive-filemanager.beta.vn/plugin.min.js')
            ]
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