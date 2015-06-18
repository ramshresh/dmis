<?php

namespace common\modules\social_media\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\modules\social_media\models\TwitterStatus;

/**
 * TwitterStatusSearch represents the model behind the search form about `common\modules\social_media\models\TwitterStatus`.
 */
class TwitterStatusSearch extends TwitterStatus
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id'], 'integer'],
            [['location', 'in_reply_to', 'status', 'in_reply_to_status_id', 'place_id', 'media_ids'], 'safe'],
            [['latitude', 'longitude', 'lat', 'long'], 'number'],
            [['possibly_sensitive', 'display_coordinates', 'is_verified'], 'boolean'],
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
        $query = TwitterStatus::find();

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
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'possibly_sensitive' => $this->possibly_sensitive,
            'lat' => $this->lat,
            'long' => $this->long,
            'display_coordinates' => $this->display_coordinates,
            'is_verified' => $this->is_verified,
        ]);

        $query->andFilterWhere(['like', 'location', $this->location])
            ->andFilterWhere(['like', 'in_reply_to', $this->in_reply_to])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'in_reply_to_status_id', $this->in_reply_to_status_id])
            ->andFilterWhere(['like', 'place_id', $this->place_id])
            ->andFilterWhere(['like', 'media_ids', $this->media_ids]);

        return $dataProvider;
    }
}
