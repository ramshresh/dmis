<?php

namespace common\modules\building_assessment\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\modules\building_assessment\models\BuildingHousehold;

/**
 * BuildingHouseholdSearch represents the model behind the search form about `common\modules\building_assessment\models\BuildingHousehold`.
 */
class BuildingHouseholdSearch extends BuildingHousehold
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'no_of_occupants', 'c_code', 'z_code', 'd_code', 'v_code', 'ward_no', 'impact_death', 'impact_injured', 'impact_missing', 'impact_displaced', 'impact_orphaned'], 'integer'],
            [['owner_name', 'owner_contact', 'occupancy_type', 'current_condition', 'income_source', 'income_level', 'construction_type', 'current_income_status', 'damage_type', 'event_name', 'timestamp_created_at', 'timestamp_updated_at', 'timestamp_occurance', 'geom', 'wkt', 'address', 'tags'], 'safe'],
            [['longitude', 'latitude'], 'number'],
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
        $query = BuildingHousehold::find();

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
            'user_id' => $this->user_id,
            'no_of_occupants' => $this->no_of_occupants,
            'timestamp_created_at' => $this->timestamp_created_at,
            'timestamp_updated_at' => $this->timestamp_updated_at,
            'timestamp_occurance' => $this->timestamp_occurance,
            'longitude' => $this->longitude,
            'latitude' => $this->latitude,
            'c_code' => $this->c_code,
            'z_code' => $this->z_code,
            'd_code' => $this->d_code,
            'v_code' => $this->v_code,
            'ward_no' => $this->ward_no,
            'impact_death' => $this->impact_death,
            'impact_injured' => $this->impact_injured,
            'impact_missing' => $this->impact_missing,
            'impact_displaced' => $this->impact_displaced,
            'impact_orphaned' => $this->impact_orphaned,
        ]);

        $query->andFilterWhere(['like', 'owner_name', $this->owner_name])
            ->andFilterWhere(['like', 'owner_contact', $this->owner_contact])
            ->andFilterWhere(['like', 'occupancy_type', $this->occupancy_type])
            ->andFilterWhere(['like', 'current_condition', $this->current_condition])
            ->andFilterWhere(['like', 'income_source', $this->income_source])
            ->andFilterWhere(['like', 'income_level', $this->income_level])
            ->andFilterWhere(['like', 'construction_type', $this->construction_type])
            ->andFilterWhere(['like', 'current_income_status', $this->current_income_status])
            ->andFilterWhere(['like', 'damage_type', $this->damage_type])
            ->andFilterWhere(['like', 'event_name', $this->event_name])
            ->andFilterWhere(['like', 'geom', $this->geom])
            ->andFilterWhere(['like', 'wkt', $this->wkt])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'tags', $this->tags]);

        return $dataProvider;
    }
}
