<?php

namespace common\modules\tracking\models\search;

use common\modules\tracking\models\Location as LocationModel;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * Location represents the model behind the search form about `common\modules\tracking\models\Location`.
 */
class Location extends LocationModel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['device_id', 'latitude', 'longitude', 'speed'], 'safe'],
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
        $query = LocationModel::find();

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

        $query->andFilterWhere(['like', 'device_id', $this->device_id])
            ->andFilterWhere(['like', 'latitude', $this->latitude])
            ->andFilterWhere(['like', 'longitude', $this->longitude])
            ->andFilterWhere(['like', 'speed', $this->speed]);

        return $dataProvider;
    }
}
