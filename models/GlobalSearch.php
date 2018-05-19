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

    public $q;

    public $searchModels = [
        [
            'class' => '\app\models\resources\Product'
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
        $query = \app\models\resources\Product::find();

        // add conditions that should always apply here

        $dataProvider = new DataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        return $dataProvider;

    }
}