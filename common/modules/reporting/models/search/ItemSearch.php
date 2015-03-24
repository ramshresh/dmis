<?php

namespace common\modules\reporting\models\search;

use common\modules\reporting\models\Item;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * ItemSearch represents the model behind the search form about `common\modules\reporting\models\Item`.
 */
class ItemSearch extends Item
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['name', 'tags', 'meta_hstore', 'meta_json', 'displayname'], 'safe'],
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
        $query = Item::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'tags', $this->tags])
            ->andFilterWhere(['like', 'meta_hstore', $this->meta_hstore])
            ->andFilterWhere(['like', 'meta_json', $this->meta_json])
            ->andFilterWhere(['like', 'displayname', $this->displayname]);

        return $dataProvider;
    }
}
