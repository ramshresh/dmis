<?php
/**
 * Created by PhpStorm.
 * User: girc
 * Date: 2/1/15
 * Time: 12:39 AM
 */
?>
<blockquote> Event </blockquote>

<?= \common\modules\reporting\widgets\EventReportCreateWidget::widget([
    'controllerRoute'=>'/reporting/event-report-widget',
    'modelEvent'=>new \common\modules\reporting\models\Event(),
    'modelReportItem'=>new \common\modules\reporting\models\ReportItem(),
    'parentReportItemId'=>318,
])?>





