<div class="reporting-default-index">
    <h1><?= $this->context->action->uniqueId ?></h1>
    <p>
        This is the view content for action "<?= $this->context->action->id ?>".
        The action belongs to the controller "<?= get_class($this->context) ?>"
        in the "<?= $this->context->module->id ?>" module.
    </p>
    <p>
        You may customize this page by editing the following file:<br>
        <code><?= __FILE__ ?></code>
    </p>
</div>
<div class="dropdown" >
    <button id="report" class="ol-has-tooltip dropdown-toggle " aria-expanded="false" data-toggle="dropdown"
            type="button">
        <i style="font-size: 22px;" class="icon-reporting"></i>
    </button>
    <ul class="dropdown-menu" role="menu" style="">
        <li style="font-weight:bold; text-align:center;">Reporting Module</li>
        <li class="divider"></li>
        <li id="report_emergency_situation" ><a  href="#">
                <icon class="icon-emergency_situation"></icon>
                Emergency Situation
            </a>
        </li>
        <li class="divider"></li>
        <li id="report_event" >
        <li><a  href="#">
                <icon class="icon-event"></icon>
                Event
            </a>
        </li>
        <li class="divider"></li>
        <li id="report_incident"><a  href="#">
                <icon class="icon-incident"></icon>
                Incident
            </a>
        </li>
        <li class="divider"></li>
        <li id="report_damage"><a  href="#">
                <icon class="icon-damage"></icon>
                Impact
            </a>
        </li>
        <li class="divider"></li>
        <li id="report_need"><a  href="#">
                <icon class="icon-need"></icon>
                Need
            </a>
        </li>
    </ul>

    <?php
    echo \common\modules\reporting\widgets\emergency_situation\Create::widget([
        'jqToggleBtnSelector' => '#report_emergency_situation',
        'widgetId' => 'emergency-situation-form-widget',
        'formId' => 'emergency-situation-form',
        'actionRoute' => 'site/emergency-situation-create'
    ]);
    ?>
    <?php
    echo \common\modules\reporting\widgets\event\Create::widget([
        'jqToggleBtnSelector' => '#report_event',
        'widgetId' => 'event-form-widget',
        'formId' => 'event-form',
        'actionRoute' => 'site/event-create'
    ]);
    ?>
    <?php
    echo \common\modules\reporting\widgets\incident\Create::widget([
        'jqToggleBtnSelector' => '#report_incident',
        'widgetId' => 'incident-form-widget',
        'formId' => 'incident-form',
        'actionRoute' => 'site/incident-create'
    ]);
    ?>
    <?php
    echo \common\modules\reporting\widgets\damage\Create::widget([
        'jqToggleBtnSelector' => '#report_damage',
        'widgetId' => 'damage-form-widget',
        'formId' => 'damage-form',
        'actionRoute' => 'site/damage-create'
    ]);
    ?>

    <?php
    echo \common\modules\reporting\widgets\need\Create::widget([
        'jqToggleBtnSelector' => '#report_need',
        'widgetId' => 'need-form-widget',
        'formId' => 'need-form',
        'actionRoute' => 'site/need-create'
    ]);
    ?>
</div>