<?php

namespace app\common\widgets\cropper;

use Yii;
use yii\base\Widget;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\helpers\Url;
use yii\web\JsExpression;

/**
 * Wrapper for Image Cropper javascript library
 * http://fengyuanchen.github.io/cropper/
 *
 * ```php
 * use Yii;
 * use app\common\widgets\cropper\Cropper;
 * use yii\web\JsExpression;
 *
 * echo Cropper::widget([
 *      // If true - it's output button for toggle modal crop window
 *      'modal' => true,
 *      // You can customize modal window. Copy  app/common/widgets/cropper/views/modal.php
 *      'modalView' => '@app/views/image/custom_modal',
 *      // URL-address for the crop-handling request
 *      // By default, sent the following post-params: x, y, width, height, rotate
 *      'cropUrl' => ['cropImage', 'id' => $image->id],
 *      // Url-path to original image for cropping
 *      'image' => Yii::$app->request->baseUrl . '/images/' . $image->src,
 *      // The aspect ratio for the area of cropping
 *      'aspectRatio' => 4 / 3, // or 16/9(wide) or 1/1(square) or any other ratio. Null - free ratio
 *      // Additional params for JS cropper plugin
 *      'pluginOptions' => [
 *          // All possible options: https://github.com/fengyuanchen/cropper/blob/master/README.md#options
 *          'minCropBoxWidth' => 500, // minimal crop area width
 *          'minCropBoxHeight' => 500, // minimal crop area height
 *      ],
 *      // HTML-options for widget container
 *      'options' => [],
 *      // HTML-options for cropper image tag
 *      'imageOptions' => [],
 *      // Additional ajax-options for send crop-request. See jQuery $.ajax() options
 *      'ajaxOptions' => [
 *          'success' => new JsExpression(<<<JS
 *              function(data) {
 *                  // data - your JSON response from [[cropUrl]]
 *                  $("#myImage").attr("src", data.croppedImageSrc);
 *              }
 * JS
 *          ),
 *      ],
 *  ]);
 *
 * ```
*/
class Cropper extends Widget
{
    /** @var string URL for send crop data */
    public $cropUrl;
    /** @var string Original image URL */
    public $image;
    /** @var float Aspect ratio for crop box. If not set(null) - it means free aspect ratio */
    public $aspectRatio;
    /** @var bool Show crop box in modal window */
    public $modal = true;
    /** @var string Name of the view file for modal cropping mode */
    public $modalView = 'modal';
    /** @var array HTML widget options */
    public $options = [];
    /** @var array Default HTML-options for image tag */
    public $defaultImageOptions = [
        'class' => 'cropper-image img-responsive',
        'alt' => 'crop-image',
    ];
    /** @var array HTML-options for image tag */
    public $imageOptions = [];
    /** @var array Default cropper options https://github.com/fengyuanchen/cropper/blob/master/README.md#options */
    public $defaultPluginOptions = [
        'strict' => true,
        'autoCropArea' => 1,
        'checkImageOrigin' => false,
        'checkCrossOrigin' => false,
        'checkOrientation' => false,
        'zoomable' => false,
    ];
    /** @var array Additional cropper options https://github.com/fengyuanchen/cropper/blob/master/README.md#options */
    public $pluginOptions = [];
    /** @var array Ajax options for send crop-reques */
    public $ajaxOptions = [
        'success' => 'js:function(data) { console.log(data); }',
    ];
    /**
     * @inheritdoc
     */
    public function run()
    {
        if (!isset($this->options['id'])) {
            $this->options['id'] = $this->getId();
        } else {
            $this->setId($this->options['id']);
        }
        $this->pluginOptions = ArrayHelper::merge($this->defaultPluginOptions, $this->pluginOptions);
        $this->imageOptions = ArrayHelper::merge($this->defaultImageOptions, $this->imageOptions);
        // Set additional cropper js-options
        if (!empty($this->aspectRatio)) {
            $this->pluginOptions['aspectRatio'] = $this->aspectRatio;
        }
        $content = '';
        if ($this->modal) {
            // Modal button
            $buttonOptions = $this->options;
            unset($buttonOptions['id']);
            $content .= Html::img($this->image,
                ArrayHelper::merge([
                    'data' => [
                        'toggle' => 'modal',
                        'target' => '#' . $this->id,
                        'crop-url' => Url::to($this->cropUrl),
                    ],
                    'class' => 'img-responsive',
                ], $buttonOptions));
            // Modal dialog
            $content .= $this->render($this->modalView, ['widget' => $this]);
        } else {
            $content .= Html::beginTag('div', $this->options);
            $content .= Html::img($this->image, $this->imageOptions);
            $content .= Html::endTag('div');
        }
        $this->registerClientScript();
        return $content;
    }
    /**
     * Registers required script for the plugin to work as jQuery image cropping
     */
    public function registerClientScript()
    {
        $view = $this->getView();
        // Register jQuery image cropping js and css files
        CropperAsset::register($view);
        // Additional plugin options
        $options = Json::encode($this->pluginOptions);
        $selector = "#$this->id .crop-image-container > img";
        if ($this->modal) {
            $ajaxOptions = Json::encode($this->ajaxOptions);
            $view->registerJs(<<<JS
(function() {
    var modalBox = $("#$this->id"),
        image = $("$selector"),
        cropBoxData,
        canvasData,
        cropUrl;
    modalBox.on("shown.bs.modal", function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        cropUrl = button.data('crop-url'); // Extract info from data-* attributes
        image.cropper($.extend({
            built: function () {
                // Strict mode: set crop box data first
                image.cropper('setCropBoxData', cropBoxData);
                image.cropper('setCanvasData', canvasData);
            },
            dragend: function() {
                cropBoxData = image.cropper('getCropBoxData');
                canvasData = image.cropper('getCanvasData');
            }
        }, $options));
    }).on('hidden.bs.modal', function () {
        cropBoxData = image.cropper('getCropBoxData');
        canvasData = image.cropper('getCanvasData');
        image.cropper('destroy');
    });
    $(document).on("click", "#$this->id .crop-submit", function(e) {
        e.preventDefault();
        $.ajax($.extend({
            method: "POST",
            url: cropUrl,
            data: image.cropper("getData"),
            dataType: "JSON",
            error: function() {
                alert("Error while cropping");
            }
        }, $ajaxOptions));
        modalBox.modal("hide");
    });
})();
JS
            );
        } else {
            $view->registerJs(";$(\"$selector\").cropper($options);");
        }
    }
}