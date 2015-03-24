<?php

namespace common\modules\reporting\models\search;

use common\modules\reporting\models\EmergencySituation as EmergencySituationModel;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * EmergencySituation represents the model behind the search form about `common\modules\reporting\models\EmergencySituation`.
 */
class EmergencySituation extends EmergencySituationModel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'reportitem_id', 'primary_event_id', 'status'], 'integer'],
            [['timestamp_declared', 'declared_by'], 'safe'],
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
        $query = EmergencySituationModel::find();

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
            'primary_event_id' => $this->primary_event_id,
            'timestamp_declared' => $this->timestamp_declared,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'declared_by', $this->declared_by]);

        return $dataProvider;
    }
}
