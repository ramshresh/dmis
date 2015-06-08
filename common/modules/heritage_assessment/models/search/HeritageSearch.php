<?php

namespace common\modules\heritage_assessment\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\modules\heritage_assessment\models\Heritage;

/**
 * HeritageSearch represents the model behind the search form about `common\modules\heritage_assessment\models\Heritage`.
 */
class HeritageSearch extends Heritage
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'd_code', 'v_code', 'ward_no', 'user_id'], 'integer'],
            [['kitta_no', 'damage_type', 'present_physical_conditions', 'historical_socio_cultural_significance', 'important_features', 'items_to_be_preserved_before','items_to_be_preserved_after', 'description', 'recorded_by', 'surveyor_opinion_before','surveyor_opinion_after', 'old_date', 'new_date', 'timestamp_created_at', 'timestamp_updated_at', 'geom', 'wkt'], 'safe'],
            [['latitude', 'longitude'], 'number'],
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
        $query = Heritage::find();

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
            'old_date' => $this->old_date,
            'new_date' => $this->new_date,
            'timestamp_created_at' => $this->timestamp_created_at,
            'timestamp_updated_at' => $this->timestamp_updated_at,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'd_code' => $this->d_code,
            'v_code' => $this->v_code,
            'ward_no' => $this->ward_no,
            'user_id' => $this->user_id,
        ]);

        $query->andFilterWhere(['like', 'kitta_no', $this->kitta_no])
            ->andFilterWhere(['like', 'damage_type', $this->damage_type])
            ->andFilterWhere(['like', 'present_physical_conditions', $this->present_physical_conditions])
            ->andFilterWhere(['like', 'historical_socio_cultural_significance', $this->historical_socio_cultural_significance])
            ->andFilterWhere(['like', 'important_features', $this->important_features])
            ->andFilterWhere(['like', 'items_to_be_preserved_before', $this->items_to_be_preserved_before])
            ->andFilterWhere(['like', 'items_to_be_preserved_after', $this->items_to_be_preserved_after])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'recorded_by', $this->recorded_by])
            ->andFilterWhere(['like', 'surveyor_opinion_before', $this->surveyor_opinion_before])
            ->andFilterWhere(['like', 'surveyor_opinion_after', $this->surveyor_opinion_after])
            ->andFilterWhere(['like', 'geom', $this->geom])
            ->andFilterWhere(['like', 'wkt', $this->wkt]);

        return $dataProvider;
    }
}
