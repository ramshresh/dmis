<?php

namespace common\modules\rapid_assessment\models\search;

use common\modules\rapid_assessment\models\ItemChild;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * ItemChildSearch represents the model behind the search form about `common\modules\rapid_assessment\models\ItemChild`.
 */
class ItemChildSearch extends ItemChild
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'parent_type', 'child_type'], 'integer'],
            [['parent_name', 'child_name'], 'safe'],
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
        $query = ItemChild::find();

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
            'parent_type' => $this->parent_type,
            'child_type' => $this->child_type,
            'is_verified' => $this->is_verified,
        ]);

        $query->andFilterWhere(['like', 'parent_name', $this->parent_name])
            ->andFilterWhere(['like', 'child_name', $this->child_name]);

        return $dataProvider;
    }
}
