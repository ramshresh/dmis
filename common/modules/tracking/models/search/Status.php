<?php

namespace common\modules\tracking\models\search;

use common\modules\tracking\models\Status as StatusModel;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * Status represents the model behind the search form about `common\modules\tracking\models\Status`.
 */
class Status extends StatusModel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['IMEI', 'status'], 'safe'],
            [['id'], 'integer'],
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
        $query = StatusModel::find();

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
        ]);

        $query->andFilterWhere(['like', 'IMEI', $this->IMEI])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
