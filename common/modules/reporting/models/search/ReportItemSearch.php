<?php

namespace common\modules\reporting\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\modules\reporting\models\ReportItem;

/**
 * ReportItemSearch represents the model behind the search form about `common\modules\reporting\models\ReportItem`.
 */
class ReportItemSearch extends ReportItem
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'type'], 'integer'],
            [['subtype_name', 'item_name', 'title', 'description', 'timestamp_created', 'timestamp_updated', 'tags', 'meta_hstore', 'meta_json'], 'safe'],
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
        $query = ReportItem::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'type' => $this->type,
            'is_verified' => $this->is_verified,
            'timestamp_created' => $this->timestamp_created,
            'timestamp_updated' => $this->timestamp_updated,
        ]);

        $query->andFilterWhere(['like', 'subtype_name', $this->subtype_name])
            ->andFilterWhere(['like', 'item_name', $this->item_name])
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'tags', $this->tags])
            ->andFilterWhere(['like', 'meta_hstore', $this->meta_hstore])
            ->andFilterWhere(['like', 'meta_json', $this->meta_json]);

        return $dataProvider;
    }
}
