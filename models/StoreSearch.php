<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Store;

/**
 * StoreSearch represents the model behind the search form of `app\models\Store`.
 */
class StoreSearch extends Store
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'store_type_id', 'is_active', 'enable_for_find_in_store', 'enable_for_store_locator'], 'integer'],
            [['code', 'store_name', 'store_locator_page_url', 'store_image', 'country', 'region_code', 'address_line_1', 'address_line_2', 'city', 'postcode'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = Store::find();

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
            'store_type_id' => $this->store_type_id,
            'is_active' => $this->is_active,
            'enable_for_find_in_store' => $this->enable_for_find_in_store,
            'enable_for_store_locator' => $this->enable_for_store_locator,
        ]);

        $query->andFilterWhere(['like', 'code', $this->code])
            ->andFilterWhere(['like', 'store_name', $this->store_name])
            ->andFilterWhere(['like', 'store_locator_page_url', $this->store_locator_page_url])
            ->andFilterWhere(['like', 'store_image', $this->store_image])
            ->andFilterWhere(['like', 'country', $this->country])
            ->andFilterWhere(['like', 'region_code', $this->region_code])
            ->andFilterWhere(['like', 'address_line_1', $this->address_line_1])
            ->andFilterWhere(['like', 'address_line_2', $this->address_line_2])
            ->andFilterWhere(['like', 'city', $this->city])
            ->andFilterWhere(['like', 'postcode', $this->postcode]);

        return $dataProvider;
    }
}
