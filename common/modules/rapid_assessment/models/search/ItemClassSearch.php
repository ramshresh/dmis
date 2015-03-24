<?php

namespace common\modules\rapid_assessment\models\search;

use common\modules\rapid_assessment\models\ItemClass;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * ItemClassSearch represents the model behind the search form about `common\modules\rapid_assessment\models\ItemClass`.
 */
class ItemClassSearch extends ItemClass
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['item_name', 'basis', 'name', 'display_name', 'range_units', 'standard', 'description'], 'safe'],
            [['range'], 'number'],
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
        $query = ItemClass::find();

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
            'range' => $this->range,
            'is_verified' => $this->is_verified,
        ]);

        $query->andFilterWhere(['like', 'item_name', $this->item_name])
            ->andFilterWhere(['like', 'basis', $this->basis])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'display_name', $this->display_name])
            ->andFilterWhere(['like', 'range_units', $this->range_units])
            ->andFilterWhere(['like', 'standard', $this->standard])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
