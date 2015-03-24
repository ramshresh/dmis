<?php

namespace common\modules\rapid_assessment\models\search;

use common\modules\rapid_assessment\models\ReportItemRating;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * ReportItemRatingSearch represents the model behind the search form about `common\modules\rapid_assessment\models\ReportItemRating`.
 */
class ReportItemRatingSearch extends ReportItemRating
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'report_item_id', 'rating', 'user_id'], 'integer'],
            [['comment', 'timestamp_created_at', 'timestamp_updated_at'], 'safe'],
            [['is_valid'], 'boolean'],
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
        $query = ReportItemRating::find();

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
            'rating' => $this->rating,
            'is_valid' => $this->is_valid,
            'user_id' => $this->user_id,
            'timestamp_created_at' => $this->timestamp_created_at,
            'timestamp_updated_at' => $this->timestamp_updated_at,
        ]);

        $query->andFilterWhere(['like', 'comment', $this->comment]);

        return $dataProvider;
    }
}
