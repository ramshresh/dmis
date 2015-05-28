<?php

namespace common\modules\rapid_assessment\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\modules\rapid_assessment\models\ReportItemImpact;

/**
 * ReportItemImpactSearch represents the model behind the search form about `common\modules\rapid_assessment\models\ReportItemImpact`.
 */
class ReportItemImpactSearch extends ReportItemImpact
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'supplied_per_person', 'no_of_occupants'], 'integer'],
            [['type', 'item_name', 'class_basis', 'class_name', 'title', 'description', 'status', 'timestamp_occurance', 'timestamp_created_at', 'timestamp_updated_at', 'tags', 'meta_hstore', 'meta_json', 'declared_by', 'timestamp_declared_at', 'units', 'wkt', 'geom', 'address', 'owner_name', 'owner_contact', 'event', 'event_name',  'income_source', 'income_level', 'current_condition', 'construction_type', 'occupancy_type', 'current_income_status'], 'safe'],
            [['is_verified'], 'boolean'],
            [['magnitude', 'latitude', 'longitude'], 'number'],
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
        $query = ReportItemImpact::find();

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
            'is_verified' => $this->is_verified,
            'timestamp_occurance' => $this->timestamp_occurance,
            'timestamp_created_at' => $this->timestamp_created_at,
            'timestamp_updated_at' => $this->timestamp_updated_at,
            'timestamp_declared_at' => $this->timestamp_declared_at,
            'magnitude' => $this->magnitude,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'user_id' => $this->user_id,
            'supplied_per_person' => $this->supplied_per_person,
            'no_of_occupants' => $this->no_of_occupants,
        ]);

        $query->andFilterWhere(['like', 'type', $this->type])
            ->andFilterWhere(['like', 'item_name', $this->item_name])
            ->andFilterWhere(['like', 'class_basis', $this->class_basis])
            ->andFilterWhere(['like', 'class_name', $this->class_name])
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'tags', $this->tags])
            ->andFilterWhere(['like', 'meta_hstore', $this->meta_hstore])
            ->andFilterWhere(['like', 'meta_json', $this->meta_json])
            ->andFilterWhere(['like', 'declared_by', $this->declared_by])
            ->andFilterWhere(['like', 'units', $this->units])
            ->andFilterWhere(['like', 'wkt', $this->wkt])
            ->andFilterWhere(['like', 'geom', $this->geom])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'owner_name', $this->owner_name])
            ->andFilterWhere(['like', 'owner_contact', $this->owner_contact])
            ->andFilterWhere(['like', 'event', $this->event])
            ->andFilterWhere(['like', 'event_name', $this->event_name])

            ->andFilterWhere(['like', 'income_source', $this->income_source])
            ->andFilterWhere(['like', 'income_level', $this->income_level])
            ->andFilterWhere(['like', 'current_condition', $this->current_condition])
            ->andFilterWhere(['like', 'construction_type', $this->construction_type])
            ->andFilterWhere(['like', 'occupancy_type', $this->occupancy_type])
            ->andFilterWhere(['like', 'current_income_status', $this->current_income_status]);

        return $dataProvider;
    }
}
