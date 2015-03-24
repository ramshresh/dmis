<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 3/10/2015
 * Time: 1:41 PM
 */
use common\modules\reporting\models\Damage;
use common\modules\reporting\models\Event;
use common\modules\reporting\models\ReportItem;

/*$reportItem607 = ReportItem::find()->where(['id'=>607])->one();
$reportItem618 = ReportItem::find()->where(['id'=>618])->one();
$reportItem618->link('reportItemChildren',$reportItem607);*/

$damageRi607 = Damage::find()->where(['reportitem_id'=>607])->one();
$eventRi618 = Event::find()->where(['reportitem_id'=>618])->one();
$eventRi618->assignChild($damageRi607);

?>

