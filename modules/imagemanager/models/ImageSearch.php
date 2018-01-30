<?php

namespace app\modules\imagemanager\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ImageManager;

/**
 * ImageSearch represents the model behind the search form of `app\models\ImageManager`.
 */
class ImageSearch extends ImageManager
{

    public $globalSearch;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['globalSearch'], 'safe'],
        ];
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
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = ImageManager::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pagesize' => 100,
            ],
            'sort'=> ['defaultOrder' => ['created_at' => SORT_DESC]]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

         $query->orFilterWhere(['like', 'name', $this->globalSearch])
            ->orFilterWhere(['like', 'path', $this->globalSearch]);

        return $dataProvider;
    }
}
