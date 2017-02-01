<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Platillo;

/**
 * PlatilloSearch represents the model behind the search form about `frontend\models\Platillo`.
 */
class PlatilloSearch extends Platillo
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_nutriologo'], 'integer'],
            [['nombre', 'cantidad', 'preparacion'], 'safe'],
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
        $query = Platillo::find();

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
            'id_nutriologo' => $this->id_nutriologo,
        ]);

        $query->andFilterWhere(['like', 'nombre', $this->nombre])
            ->andFilterWhere(['like', 'cantidad', $this->cantidad])
            ->andFilterWhere(['like', 'preparacion', $this->preparacion]);

        return $dataProvider;
    }
}
