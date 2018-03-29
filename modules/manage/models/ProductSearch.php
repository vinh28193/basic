<?php

namespace app\modules\manage\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\resources\Product;

/**
 * ProductSearch represents the model behind the search form of `app\models\resources\Product`.
 */
class ProductSearch extends Product
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'tenant_id', 'category_id', 'seller_id', 'updater_id', 'start_price', 'sell_price', 'quantity_available', 'quantity_sold', 'deal_time', 'condition_id', 'is_free_shipping', 'status', 'created_at', 'updated_at'], 'integer'],
            [['sku', 'title', 'slug', 'description', 'thumbnail_base_path', 'thumbnail_path'], 'safe'],
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
        $query = Product::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'tenant_id' => $this->tenant_id,
            'category_id' => $this->category_id,
            'seller_id' => $this->seller_id,
            'updater_id' => $this->updater_id,
            'start_price' => $this->start_price,
            'sell_price' => $this->sell_price,
            'quantity_available' => $this->quantity_available,
            'quantity_sold' => $this->quantity_sold,
            'deal_time' => $this->deal_time,
            'condition_id' => $this->condition_id,
            'is_free_shipping' => $this->is_free_shipping,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'sku', $this->sku])
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'slug', $this->slug])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'thumbnail_base_path', $this->thumbnail_base_path])
            ->andFilterWhere(['like', 'thumbnail_path', $this->thumbnail_path]);

        return $dataProvider;
    }
}
