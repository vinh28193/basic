<?php

namespace app\common\widgets;

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use dosamigos\tinymce\TinyMce;
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
class TinyMCE extends TinyMce
{
	/**
     * @inheritdoc
     */
	public function init(){
		parent::init();
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