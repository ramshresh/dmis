<?php

namespace common\modules\rapid_assessment\models\search;

use common\modules\rapid_assessment\models\ItemType;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * ItemTypeSearch represents the model behind the search form about `common\modules\rapid_assessment\models\ItemType`.
 */
class ItemTypeSearch extends ItemType
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'type'], 'integer'],
            [['item_name', 'description'], 'safe'],
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
        $query = ItemType::find();

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
            'type' => $this->type,
            'is_verified' => $this->is_verified,
        ]);

        $query->andFilterWhere(['like', 'item_name', $this->item_name])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
