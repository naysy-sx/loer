<?php

namespace app\models\db;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\db\Clients;

/**
 * ClientsSearch represents the model behind the search form of `app\models\db\Clients`.
 */
class ClientsSearch extends Clients
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'company_id', 'user_id', 'created_at', 'status_position'], 'integer'],
            [['family', 'first_name', 'middle_name', 'avatar', 'pasport_serial', 'pasport_number', 'category_id', 'proc_status', 'inn', 'ogrn', 'kpp', 'jur_index', 'jur_address', 'fact_index', 'fact_address', 'email', 'phone', 'status', 'comment'], 'safe'],
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
        $query = Clients::find();

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
            'company_id' => $this->company_id,
            'user_id' => $this->user_id,
            'created_at' => $this->created_at,
            'status_position' => $this->status_position,
        ]);

        $query->andFilterWhere(['like', 'family', $this->family])
            ->andFilterWhere(['like', 'first_name', $this->first_name])
            ->andFilterWhere(['like', 'middle_name', $this->middle_name])
            ->andFilterWhere(['like', 'avatar', $this->avatar])
            ->andFilterWhere(['like', 'pasport_serial', $this->pasport_serial])
            ->andFilterWhere(['like', 'pasport_number', $this->pasport_number])
            ->andFilterWhere(['like', 'category_id', $this->category_id])
            ->andFilterWhere(['like', 'proc_status', $this->proc_status])
            ->andFilterWhere(['like', 'inn', $this->inn])
            ->andFilterWhere(['like', 'ogrn', $this->ogrn])
            ->andFilterWhere(['like', 'kpp', $this->kpp])
            ->andFilterWhere(['like', 'jur_index', $this->jur_index])
            ->andFilterWhere(['like', 'jur_address', $this->jur_address])
            ->andFilterWhere(['like', 'fact_index', $this->fact_index])
            ->andFilterWhere(['like', 'fact_address', $this->fact_address])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'comment', $this->comment]);

        return $dataProvider;
    }
}
