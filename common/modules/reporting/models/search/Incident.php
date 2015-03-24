<?php

namespace common\modules\reporting\models\search;

use common\modules\reporting\models\Incident as IncidentModel;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * Incident represents the model behind the search form about `common\modules\reporting\models\Incident`.
 */
class Incident extends IncidentModel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'reportitem_id', 'status'], 'integer'],
            [['timestamp_occurance', 'duration'], 'safe'],
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
        $query = IncidentModel::find();

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
            'reportitem_id' => $this->reportitem_id,
            'timestamp_occurance' => $this->timestamp_occurance,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'duration', $this->duration]);

        return $dataProvider;
    }
}
