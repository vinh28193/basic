<?php
namespace app\common\grid;

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\helpers\Url;
use yii\web\JsExpression;
use yii\web\View;

/**
  * The DataColumn is the default column type for the [[Grid]] widget and extends the [[BaseDataColumn]] with various
 * enhancements.
 */
class DataColumn extends \yii\grid\DataColumnn
{
	/**
     * @inheritdoc
     */
    public function renderDataCell($model, $key, $index)
    {
        return parent::renderDataCell($model, $key, $index);
    }
	
}

 ?>