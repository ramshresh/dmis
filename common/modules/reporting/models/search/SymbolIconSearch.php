<?php

namespace common\modules\reporting\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\modules\reporting\models\SymbolIcon;

/**
 * SymbolIconSearch represents the model behind the search form about `common\modules\reporting\models\SymbolIcon`.
 */
class SymbolIconSearch extends SymbolIcon
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'type', 'size', 'resolution_x', 'resolution_y'], 'integer'],
            [['name', 'format', 'extension', 'path', 'url', 'source', 'description', 'tags', 'meta_hstore', 'meta_json'], 'safe'],
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
        $query = SymbolIcon::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'type' => $this->type,
            'size' => $this->size,
            'resolution_x' => $this->resolution_x,
            'resolution_y' => $this->resolution_y,
            'is_verified' => $this->is_verified,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'format', $this->format])
            ->andFilterWhere(['like', 'extension', $this->extension])
            ->andFilterWhere(['like', 'path', $this->path])
            ->andFilterWhere(['like', 'url', $this->url])
            ->andFilterWhere(['like', 'source', $this->source])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'tags', $this->tags])
            ->andFilterWhere(['like', 'meta_hstore', $this->meta_hstore])
            ->andFilterWhere(['like', 'meta_json', $this->meta_json]);

        return $dataProvider;
    }
}
