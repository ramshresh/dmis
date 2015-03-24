<?php

namespace common\modules\reporting\models\search;

use common\modules\reporting\models\Event;
use common\modules\reporting\models\ReportItem;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * EventSearch represents the model behind the search form about `common\modules\reporting\models\Event`.
 */
class EventSearch extends Event
{
    //{{{ initialization
    public function init()
    {
        parent::init();
        /**
         * 'search' scenario has been defined in model ReportItem
         *  Models 'EventSearch' --extends--> 'EventModel' --extends--> 'ReportItemModel'
         */
        $this->scenario = 'search';
    }
    //}}} ./Initialization

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'reportitem_id', 'status'], 'integer'],
            [['timestamp_occurance', 'duration'], 'safe'],
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
        $query = Event::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        //{{{ dataprovider's sort attributes for ReportItem
        /**
         * Provides Sorting function (OR-links A->Z and Z->A) in GridView
         * @IMPORTANT These assignments must be made before executing:
         *          $this->load($params);
         */
        $dataProvider->sort->attributes['item_name']=[
            'asc' => [ReportItem::tableName() . '.item_name' => SORT_ASC],
            'desc' => [ReportItem::tableName() . '.item_name' => SORT_DESC],
            'label' => 'Item Name',
        ];
        $dataProvider->sort->attributes['type']=[
            'asc' => [ReportItem::tableName() . '.type' => SORT_ASC],
            'desc' => [ReportItem::tableName() . '.type' => SORT_DESC],
            'label' => 'Type',
        ];
        $dataProvider->sort->attributes['is_verified']=[
            'asc' => [ReportItem::tableName() . '.is_verified' => SORT_ASC],
            'desc' => [ReportItem::tableName() . '.is_verified' => SORT_DESC],
            'label' => 'Is Verified',
        ];
        $dataProvider->sort->attributes['timestamp_created']=[
            'asc' => [ReportItem::tableName() . '.timestamp_created' => SORT_ASC],
            'desc' => [ReportItem::tableName() . '.timestamp_created' => SORT_DESC],
            'label' => 'Created at',
        ];
        $dataProvider->sort->attributes['timestamp_updated']=[
            'asc' => [ReportItem::tableName() . '.timestamp_updated' => SORT_ASC],
            'desc' => [ReportItem::tableName() . '.timestamp_updated' => SORT_DESC],
            'label' => 'Updated at',
        ];
        $dataProvider->sort->attributes['subtype_name']=[
            'asc' => [ReportItem::tableName() . '.subtype_name' => SORT_ASC],
            'desc' => [ReportItem::tableName() . '.subtype_name' => SORT_DESC],
            'label' => 'Subtype',
        ];
        //}}} ./dataprovider's sort attributes for ReportItem

        if (!($this->load($params) && $this->validate())) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');

            // Preloading related <reportitem> model with join
            $query->joinWith(['reportitem']);

            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'reportitem_id' => $this->reportitem_id,
            'timestamp_occurance' => $this->timestamp_occurance,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'duration', $this->duration]);

        $query->joinWith(

            [/**
             * For making Columns from relationship <reportitem> searchable
             */
                'reportitem' => function ($q) {
                    /**
                     * sample
                     * $q->andFilterWhere(['like', ReportItem::tableName().".item_name", $this->itemName]);
                     * ---OR---Equivalent
                     * $q->where(ReportItem::tableName() . ".item_name LIKE '%" . $this->itemName . "%' ");
                     */
                    $q->andFilterWhere(['like', ReportItem::tableName().".item_name", $this->item_name]);
                    $q->andFilterWhere(['like', ReportItem::tableName().".subtype_name", $this->subtype_name]);
                    $q->andFilterWhere(['=', ReportItem::tableName().".type", $this->type]);
                    $q->andFilterWhere(['=', ReportItem::tableName().".is_verified", $this->is_verified]);
                    $q->andFilterWhere(['=', ReportItem::tableName().".is_verified", $this->timestamp_created]);
                    $q->andFilterWhere(['=', ReportItem::tableName().".is_verified", $this->timestamp_created]);
                }]
        );

        return $dataProvider;
    }
}
