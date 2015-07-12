<?php

namespace common\modules\tbi\models\search;

use common\modules\user\models\Profile;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\modules\tbi\models\Building;

/**
 * BuildingSearch represents the model behind the search form about `common\modules\tbi\models\Building`.
 */
class BuildingSearch extends Building
{
    public $userProfileFullName;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'no_of_storey', 'ward_no', 'v_code', 'd_code', 'z_code'], 'integer'],
            [['surveyor','year_of_construction',  'surveyed_by', 'survey_date', 'owner_name', 'owner_contact', 'owner_comment', 'building_name', 'current_use', 'special_features', 'type', 'type_other', 'style', 'style_other', 'physical_condition', 'physical_condition_comment', 'street', 'settlement', 'surveyed_at', 'timestamp_created_at', 'timestamp_updated_at', 'geom', 'wkt'], 'safe'],
            [['latitude', 'longitude'], 'number'],
            [['userProfileFullName'], 'safe'],
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
        $query = Building::find();

        // Important: lets join the query with our previously mentioned relations
        // I do not make any other configuration like aliases or whatever, feel free
        // to investigate that your self
        $query->joinWith(['user']);
        $query->joinWith(['userProfile']);


        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->sort->attributes['userProfileFullName'] = [
            // The tables are the ones our relation are configured to
            // in my case they are prefixed with "tbl_"
            'asc' => [Profile::getTableSchema()->getColumn('full_name')->name => SORT_ASC],
            'desc' => [Profile::getTableSchema()->getColumn('full_name')->name => SORT_DESC],
        ];

        // No search? Then return data Provider
        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'user_id' => $this->user_id,
            'survey_date' => $this->survey_date,
            'no_of_storey' => $this->no_of_storey,
            'ward_no' => $this->ward_no,
            'v_code' => $this->v_code,
            'd_code' => $this->d_code,
            'z_code' => $this->z_code,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'surveyed_at' => $this->surveyed_at,
            'timestamp_created_at' => $this->timestamp_created_at,
            'timestamp_updated_at' => $this->timestamp_updated_at,
        ]);

        $query->andFilterWhere(['like', 'surveyor', $this->surveyor])
            ->andFilterWhere(['like', 'year_of_construction', $this->year_of_construction])
            ->andFilterWhere(['like', 'surveyed_by', $this->surveyed_by])
            ->andFilterWhere(['like', 'owner_name', $this->owner_name])
            ->andFilterWhere(['like', 'owner_contact', $this->owner_contact])
            ->andFilterWhere(['like', 'owner_comment', $this->owner_comment])
            ->andFilterWhere(['like', 'building_name', $this->building_name])
            ->andFilterWhere(['like', 'current_use', $this->current_use])
            ->andFilterWhere(['like', 'special_features', $this->special_features])
            ->andFilterWhere(['like', 'type', $this->type])
            ->andFilterWhere(['like', 'type_other', $this->type_other])
            ->andFilterWhere(['like', 'style', $this->style])
            ->andFilterWhere(['like', 'style_other', $this->style_other])
            ->andFilterWhere(['like', 'physical_condition', $this->physical_condition])
            ->andFilterWhere(['like', 'physical_condition_comment', $this->physical_condition_comment])
            ->andFilterWhere(['like', 'street', $this->street])
            ->andFilterWhere(['like', 'settlement', $this->settlement])
            ->andFilterWhere(['like', 'geom', $this->geom])
            ->andFilterWhere(['like', 'wkt', $this->wkt]);

        // Here we search the attributes of our relations using our previously configured
        // ones in "HeritageSearch"
        $query->andFilterWhere(['like', Profile::getTableSchema()->getColumn('full_name')->name, $this->userProfileFullName]);

        return $dataProvider;
    }
}
