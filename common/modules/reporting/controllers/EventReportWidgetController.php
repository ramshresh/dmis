<?php

namespace common\modules\reporting\controllers;

use common\components\MyBaseContoller;
use common\modules\reporting\models\Damage;
use common\modules\reporting\models\Event;
use common\modules\reporting\models\ItemSubType;
use common\modules\reporting\models\ItemType;
use common\modules\reporting\models\ReportItem;
use Yii;
use yii\base\Model;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;

/**
 * CrudItemChildController implements the CRUD actions for ItemChild model.
 */
class EventReportWidgetController extends MyBaseContoller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Event Report-items
     * @return mixed
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Method to update  via AJAX.
     * On success returns JSON array of objects
     *
     * @throws CHttpException
     */
    public function actionChangeData()
    {
        if (!Yii::$app->request->post('ReportItem') || !Yii::$app->request->post('Event') ) throw new CHttpException(400, 'Nothing, to save');
        $reportItemData=Yii::$app->request->post('ReportItem');
        $eventData=Yii::$app->request->post('Event');
        $parentReportItemId=Yii::$app->request->post('parentReportItemId');

        $reportItem=ReportItem::find()
            ->where(
                'id=:id',
                [':id'=>$reportItemData['id']]
            )->one();
        $event=Event::find()
            ->where('id=:id',
                [':id'=>$eventData['id']]
            )->one();
        if($parentReportItemId!=''){
            $parentReportItem=ReportItem::find()
                ->where(
                    'id=:id',
                    [':id'=>$parentReportItemId]
                )->one();
        }
        $reportItem->load($reportItemData);
        $event->load($eventData);
        $reportItem->save();
        $event->save();
    }

    /**
     * Creates a new Event Report
     * @return mixed
     */
    public function actionCreate()
    {
        $reportItem = new ReportItem();
        $reportItem->type = ReportItem::TYPE_EVENT;
        $event = new Event();

        $parentReportItemId=Yii::$app->request->post('parentReportItemId');




        if($parentReportItemId!=''){
            $parentReportItem=ReportItem::find()
                ->where(
                    'id=:id',
                    [':id'=>$parentReportItemId]
                )->one();
        }

        $dropDownItemName =  ArrayHelper::map(ItemType::find()
            ->where('type=:type',[':type'=>ReportItem::TYPE_EVENT])
            ->all(), 'item_name', 'item_name');

        if(Yii::$app->request->isAjax){

            if ($reportItem->load(Yii::$app->request->post()) && $event->load(Yii::$app->request->post()) && Model::validateMultiple([$reportItem, $event])) {
                $transaction = Yii::$app->db->beginTransaction();
                try {
                    if ($reportItem->save()) {
                        if($parentReportItem){
                            //$parentReportItem->link('reportItemChildren',$reportItem);
                        }
                        $event->link('reportItem', $reportItem);
                        $event->save();

                        $damages=[];


                        $postData = Yii::$app->request->post('Damage');
                        if ($postData) {
                            foreach ($postData as $i => $single) {
                                $damages[$i] = new Damage();
                                $damages[$i]->load($single);
                            }
                        }

                        if (Model::loadMultiple($damages, Yii::$app->request->post())) {
                            foreach($damages as $damage){
                                $damage->save();
                                $r = new ReportItem();
                                $r->type=ReportItem::TYPE_DAMAGE;

                                $damage->link('reportitem', $reportItem);

                            }
                        }





                        $transaction->commit();
                        $this->sendSuccessResponseOnAjaxFormSubmit('Saved');
                        //return $this->renderAjax('_growl_success',['title'=>'success','body'=>'created']);
                    }else{
                        //return $this->renderAjax('_growl',['title'=>'error','body'=>'error']);
                        $this->sendErrorResponseOnAjaxFormSubmit([$reportItem]);
                    }
                } catch (\yii\base\Exception $e) {
                    $transaction->rollBack();
                    $this->sendExceptionErrorOnAjaxFormSubmit($e);
                    throw $e;
                    /*return $this->renderAjax('_growl_error',
                        ['title' => $e->getCode() . ':' . $e->getName(),
                            'body' => 'message' . $e->getMessage() . '<br>' . $e->getFile() . ':' . $e->getLine()]);*/
                }
            } else {
                $this->sendErrorResponseOnAjaxFormSubmit([$reportItem,$event]);
                //echo Json::encode($reportItem->errors);
                //echo Json::encode($event->errors);
                Yii::$app->end();
            }
        }
            /*if(Yii::$app->request->isAjax) {
                if (Yii::$app->request->post()) {
                    $reportItem->load(Yii::$app->request->post());
                    $event->load(Yii::$app->request->post());

                    $transaction = Yii::$app->db->beginTransaction();
                    try {
                        if ($reportItem->save()) {
                            $event->link('reportItem', $reportItem);
                            $event->save();
                            $transaction->commit();
                            return $this->renderAjax('_growl_success',['title'=>'success','body'=>'created']);
                        }else{
                            //return $this->renderAjax('_growl',['title'=>'error','body'=>'error']);
                            $this->sendErrorResponseOnAjaxFormSubmit([$reportItem]);
                        }
                    } catch (\yii\base\Exception $e) {
                        $transaction->rollBack();
                        return $this->renderAjax('_growl',
                            ['title' => $e->getCode() . ':' . $e->getName(),
                                'body' => 'message' . $e->getMessage() . '<br>' . $e->getFile() . ':' . $e->getLine()]);
                    }
                }
            }*/

        return $this->render('create', [
            'reportItem' => $reportItem,
            'event' => $event,
            'dropDownItemName'=>$dropDownItemName,
        ]);

    }


    public function actionItemSubType() {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $cat_id = $parents[0];
                //$out = self::getSubCatList($cat_id);
                $items =  ItemSubType::find()
                    ->where('item_name=:item_name',[':item_name'=>$cat_id])
                    ->all();

                foreach($items as $item ){
                    $row=[];
                    $row['id']=$item->attributes['name'];
                    $row['name']=$item->attributes['name'];
                    array_push($out,$row);
                }

// the getSubCatList function will query the database based on the
// cat_id and return an array like below:
// [
// ['id'=>'<sub-cat-id-1>', 'name'=>'<sub-cat-name1>'],
// ['id'=>'<sub-cat_id_2>', 'name'=>'<sub-cat-name2>']
// ]
                echo Json::encode(['output'=>$out, 'selected'=>'']);
                Yii::$app->end();
                return;
            }
        }
        echo Json::encode(['output'=>'', 'selected'=>'']);
    }



}
