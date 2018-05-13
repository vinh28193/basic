<?php
namespace app\models;

use Yii;
use yii\base\Model;
use yii\helpers\ArrayHelper;
use app\common\data\DataProvider;
/**
 * Class GlobalSearch
 * @package app\models
 */
class GlobalSearch extends Model
{
    const SEARCH_KEY_ALL = 'all';
    const SCENARIO_SEARCH_GLOBAL = 'global';

    public $keyword;

    public $searchModels = [
        [
            'class' => '\app\models\resources\Product.php'
        ]
    ];
    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return ArrayHelper::merge(parent::behaviors(),[

        ]);
    }
    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return ArrayHelper::merge(parent::rules(),[

        ]);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return ArrayHelper::merge(parent::attributeLabels(),[

        ]);
    }

    public function getModels(){

    }
    public function search($params){
        $query = $this->getModels();

    }
}