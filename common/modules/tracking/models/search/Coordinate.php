<?php

namespace common\modules\tracking\models\search;

use common\modules\tracking\models\Coordinate as CoordinateModel;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * Coordinate represents the model behind the search form about `common\modules\tracking\models\Coordinate`.
 */
class Coordinate extends CoordinateModel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['device_id', 'longitude', 'latitude', 'speed'], 'safe'],
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
        $query = CoordinateModel::find();

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
            ->andFilterWhere(['like', 'longitude', $this->longitude])
            ->andFilterWhere(['like', 'latitude', $this->latitude])
            ->andFilterWhere(['like', 'speed', $this->speed]);

        return $dataProvider;
    }
}
