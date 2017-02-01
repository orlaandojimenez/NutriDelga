<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Alimento;

/**
 * AlimentoSearch represents the model behind the search form about `frontend\models\Alimento`.
 */
class AlimentoSearch extends Alimento
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_nutriologo', 'kcal', 'por_lipidos', 'por_proteinas', 'por_carbohidratos', 'rico_en', 'racion'], 'integer'],
            [['nombre', 'descripcion'], 'safe'],
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
        $query = Alimento::find();

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
            'kcal' => $this->kcal,
            'por_lipidos' => $this->por_lipidos,
            'por_proteinas' => $this->por_proteinas,
            'por_carbohidratos' => $this->por_carbohidratos,
            'rico_en' => $this->rico_en,
            'racion' => $this->racion,
        ]);

        $query->andFilterWhere(['like', 'nombre', $this->nombre]);
           // ->andFilterWhere(['like', 'descripcion', $this->descripcion]);

        return $dataProvider;
    }
}
