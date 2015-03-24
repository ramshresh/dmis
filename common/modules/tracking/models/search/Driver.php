<?php

namespace common\modules\tracking\models\search;

use common\modules\tracking\models\Driver as DriverModel;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * Driver represents the model behind the search form about `common\modules\tracking\models\Driver`.
 */
class Driver extends DriverModel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Firstname', 'Lastname', 'Address', 'Phonr', 'IMEI', 'Gender', 'Ambulance_Number'], 'safe'],
            [['id'], 'integer'],
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
        $query = DriverModel::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
        ]);

        $query->andFilterWhere(['like', 'Firstname', $this->Firstname])
            ->andFilterWhere(['like', 'Lastname', $this->Lastname])
            ->andFilterWhere(['like', 'Address', $this->Address])
            ->andFilterWhere(['like', 'Phonr', $this->Phonr])
            ->andFilterWhere(['like', 'IMEI', $this->IMEI])
            ->andFilterWhere(['like', 'Gender', $this->Gender])
            ->andFilterWhere(['like', 'Ambulance_Number', $this->Ambulance_Number]);

        return $dataProvider;
    }
}
