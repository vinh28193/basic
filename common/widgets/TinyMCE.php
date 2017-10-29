<?php

namespace app\common\widgets;

use yii\helpers\Html;
use yii\helpers\Json;
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
			'automatic_uploads' => true,
			'images_upload_url' => 'manage/upload-image',
			'images_upload_handler' => new JsExpression('function (blobInfo, success, failure) {
			    setTimeout(function() {
			      	success("http://moxiecode.cachefly.net/tinymce/v9/images/logo.png");
			    }, 2000);
			  }'),
			// 'init_instance_callback' => new JsExpression('function (ed) {
			//     ed.execCommand("mceImage");
			//   }'),
			'file_picker_types' => 'image',
			'file_picker_callback' => new JsExpression('function(cb, value, meta) {
			    var input = document.createElement("input");
			    input.setAttribute("type", "file");
			    input.setAttribute("accept", "image/*");
			    input.onchange = function() {
			      var file = this.files[0];
			      
			      var reader = new FileReader();
			      reader.onload = function () {
			 
			        var id = "blobid" + (new Date()).getTime();
			        var blobCache =  tinymce.activeEditor.editorUpload.blobCache;
			        var base64 = reader.result.split(",")[1];
			        var blobInfo = blobCache.create(id, file, base64);
			        blobCache.add(blobInfo);

			        // call the callback and populate the Title field with the file name
			        cb(blobInfo.blobUri(), { title: file.name });
			      };
			      reader.readAsDataURL(file);
			    };
			    
			    input.click();
			  }'),
			'content_css' => [
				'//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
		    	'//www.tinymce.com/css/codepen.min.css'
			],
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