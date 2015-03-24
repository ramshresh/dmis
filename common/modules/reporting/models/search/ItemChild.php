<?php

namespace common\modules\reporting\models\search;

use common\modules\reporting\models\ItemChild as ItemChildModel;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * ItemChild represents the model behind the search form about `common\modules\reporting\models\ItemChild`.
 */
class ItemChild extends ItemChildModel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'parent_type', 'child_type'], 'integer'],
            [['parent_name', 'child_name'], 'safe'],
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
        $query = ItemChildModel::find();

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
        ]);

        $query->andFilterWhere(['like', 'parent_name', $this->parent_name])
            ->andFilterWhere(['like', 'child_name', $this->child_name]);

        return $dataProvider;
    }
}
