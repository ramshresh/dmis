<?php

namespace common\modules\file_management\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\modules\file_management\models\TempUploadedFile;

/**
 * TempUploadedFileSearch represents the model behind the search form about `common\modules\file_management\models\TempUploadedFile`.
 */
class TempUploadedFileSearch extends TempUploadedFile
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'error', 'size'], 'integer'],
            [['base_name', 'extension', 'name', 'temp_name', 'type', 'data', 'file'], 'safe'],
            [['has_error'], 'boolean'],
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
        $query = TempUploadedFile::find();

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
            'error' => $this->error,
            'has_error' => $this->has_error,
            'size' => $this->size,
        ]);

        $query->andFilterWhere(['like', 'base_name', $this->base_name])
            ->andFilterWhere(['like', 'extension', $this->extension])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'temp_name', $this->temp_name])
            ->andFilterWhere(['like', 'type', $this->type])
            ->andFilterWhere(['like', 'data', $this->data])
            ->andFilterWhere(['like', 'file', $this->file]);

        return $dataProvider;
    }
}
