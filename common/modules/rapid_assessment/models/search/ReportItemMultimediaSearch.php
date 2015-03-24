<?php

namespace common\modules\rapid_assessment\models\search;

use common\modules\rapid_assessment\models\ReportItemMultimedia;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * ReportItemMultimediaSearch represents the model behind the search form about `common\modules\rapid_assessment\models\ReportItemMultimedia`.
 */
class ReportItemMultimediaSearch extends ReportItemMultimedia
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'report_item_id', 'resolution_x', 'resolution_y', 'size_bytes'], 'integer'],
            [['type', 'title', 'extension', 'thumbnail_url', 'description', 'url', 'path', 'timestamp_taken_at', 'caption', 'tags', 'meta_hstore', 'meta_json'], 'safe'],
            [['latitude', 'longitude'], 'number'],
            [['is_verified'], 'boolean'],
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
        $query = ReportItemMultimedia::find();

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
            'report_item_id' => $this->report_item_id,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'timestamp_taken_at' => $this->timestamp_taken_at,
            'resolution_x' => $this->resolution_x,
            'resolution_y' => $this->resolution_y,
            'size_bytes' => $this->size_bytes,
            'is_verified' => $this->is_verified,
        ]);

        $query->andFilterWhere(['like', 'type', $this->type])
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'extension', $this->extension])
            ->andFilterWhere(['like', 'thumbnail_url', $this->thumbnail_url])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'url', $this->url])
            ->andFilterWhere(['like', 'path', $this->path])
            ->andFilterWhere(['like', 'caption', $this->caption])
            ->andFilterWhere(['like', 'tags', $this->tags])
            ->andFilterWhere(['like', 'meta_hstore', $this->meta_hstore])
            ->andFilterWhere(['like', 'meta_json', $this->meta_json]);

        return $dataProvider;
    }
}
