<?php

namespace common\modules\reporting\models\search;

use common\modules\reporting\models\ItemSymbolIcon;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * ItemSymbolIconSearch represents the model behind the search form about `common\modules\reporting\models\ItemSymbolIcon`.
 */
class ItemSymbolIconSearch extends ItemSymbolIcon
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'symbol_id'], 'integer'],
            [['item_name'], 'safe'],
            [['is_default'], 'boolean'],
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
        $query = ItemSymbolIcon::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'symbol_id' => $this->symbol_id,
            'is_default' => $this->is_default,
        ]);

        $query->andFilterWhere(['like', 'item_name', $this->item_name]);

        return $dataProvider;
    }
}
