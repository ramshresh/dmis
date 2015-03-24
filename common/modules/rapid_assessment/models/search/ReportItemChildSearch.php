<?php

namespace common\modules\rapid_assessment\models\search;

use common\modules\rapid_assessment\models\ReportItemChild;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * ReportItemChildSearch represents the model behind the search form about `common\modules\rapid_assessment\models\ReportItemChild`.
 */
class ReportItemChildSearch extends ReportItemChild
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'parent_id', 'child_id', 'parent_type', 'child_type'], 'integer'],
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
        $query = ReportItemChild::find();

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
            'parent_id' => $this->parent_id,
            'child_id' => $this->child_id,
            'parent_type' => $this->parent_type,
            'child_type' => $this->child_type,
        ]);

        return $dataProvider;
    }
}
