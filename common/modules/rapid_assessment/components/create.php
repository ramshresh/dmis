<?php
/* @var $this DisasterIncidentController */
/* @var $model DisasterIncident */
/* @var $photos xupload.models.XUploadForm */
/* @var $gallery Gallery */

$this->breadcrumbs = array(
    'Disaster Incidents' => array('index'),
    'Create',
);

$this->menu = array(
    array('label' => 'List DisasterIncident', 'url' => array('index')),
    array('label' => 'Manage DisasterIncident', 'url' => array('admin')),
);
?>
<div id="form">
    <h1>Create DisasterIncident</h1>
    <?php $this->renderPartial('_form', array('model' => $model, 'photos' => $photos, 'gallery' => $gallery)); ?>
</div>-->

