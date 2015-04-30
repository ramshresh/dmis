<?php

namespace common\modules\social_media\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\modules\social_media\models\Tweet;

/**
 * TweetSearch represents the model behind the search form about `common\modules\social_media\models\Tweet`.
 */
class TweetSearch extends Tweet
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id'], 'integer'],
            [['tweets', 'geom', 'status_json', 'date', 'hashtags', 'tweet_location', 'screen_name', 'date_utc', 'user_address', 'tweet_long', 'tweet_lat', 'user_long', 'user_lat', 'user_geom', 'media_url'], 'safe'],
            [['verified'], 'boolean'],
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
        $query = Tweet::find();

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
            'verified' => $this->verified,
        ]);

        $query->andFilterWhere(['like', 'tweets', $this->tweets])
            ->andFilterWhere(['like', 'geom', $this->geom])
            ->andFilterWhere(['like', 'status_json', $this->status_json])
            ->andFilterWhere(['like', 'date', $this->date])
            ->andFilterWhere(['like', 'hashtags', $this->hashtags])
            ->andFilterWhere(['like', 'tweet_location', $this->tweet_location])
            ->andFilterWhere(['like', 'screen_name', $this->screen_name])
            ->andFilterWhere(['like', 'date_utc', $this->date_utc])
            ->andFilterWhere(['like', 'user_address', $this->user_address])
            ->andFilterWhere(['like', 'tweet_long', $this->tweet_long])
            ->andFilterWhere(['like', 'tweet_lat', $this->tweet_lat])
            ->andFilterWhere(['like', 'user_long', $this->user_long])
            ->andFilterWhere(['like', 'user_lat', $this->user_lat])
            ->andFilterWhere(['like', 'user_geom', $this->user_geom])
            ->andFilterWhere(['like', 'media_url', $this->media_url]);

        return $dataProvider;
    }
}
