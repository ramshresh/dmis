<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 4/22/2015
 * Time: 10:18 AM
 *
 * @var $this yii\web\View
 * @var $searchModel \common\modules\rapid_assessment\models\search\ReportItemSearch
 * @var $dataProvider
 * @var $model \common\modules\rapid_assessment\models\ReportItem
 */
use miloschuman\highcharts\HighchartsAsset;
use yii\helpers\Html;
use yii\web\JqueryAsset;
use yii\widgets\Pjax;

JqueryAsset::register($this, $this::POS_END);
HighchartsAsset::register($this,$this::POS_END)->withScripts(['highcharts','highstock', 'modules/exporting', 'modules/drilldown']);
?>
<div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
<div id="hc_timeline"></div>



<?= Html::activeInput('text', $searchModel, 'item_name') ?>
<?= Html::a("Refresh", ['list'], ['id'=>'refresh', 'class' => 'btn btn-lg btn-primary']) ?>

<?php Pjax::begin(['id'=>'result']); ?>

<h4>Current time: <?= $time ?></h4>
<hr>
<h5>Report Item Ids</h5>

<ul>
    <?php foreach ($dataProvider->models as $model): ?>
        <li><?= $model->id; ?></li>
    <?php endforeach; ?>
</ul>
<?php Pjax::end(); ?>
<script>
    <?php  $this->beginBlock('test')?>
    $('#refresh').click(function (e) {
        e.preventDefault();
        var type = $("#<?=Html::getInputId($searchModel,'item_name')?>").val();
        var data = {
            "<?=Html::getInputName($searchModel,'item_name')?>": type
        }
        var url = "<?=Yii::$app->request->url?>";
        $.ajax({
            url: url,
            data: data,
            method: "POST",
            success: function (data) {
                JSON.stringify(data);
                alert('success');
                $.pjax.reload({url: url, container:'#result'});
            },
            error: function () {
                alert('error');
            }
        });
    });

    var hc_function = function(div,type,data){
        $(div).highcharts({
            chart: {
                type: type,
                zoomType: 'x'

            },
            title: {
                text: 'Report Items Time Line'
            },
            subtitle: {
                text: document.ontouchstart === undefined ?
                    'Click and drag in the plot area to zoom in' :
                    'Pinch the chart to zoom in'
            },
            credits: {
                enabled: true,
                style:{
                    cursor: 'pointer',
                    color: '#909090',
                    fontSize: '10px'
                },
                position: {
                    align: 'right',
                    x: -10,
                    verticalAlign: 'bottom',
                    y: -5
                },
                href: "http://116.90.239.21",
                text: "Dmis-Geospatial Lab"
            },
            xAxis: {
                type: 'datetime',
                dateTimeLabelFormats: { // don't display the dummy year
                    month: '%e. %b',
                    year: '%b'
                },
                title: {
                    text: 'Date'
                }

            },
            scrollbar: {
                enabled: true
            },

            yAxis: {
                title: {
                    text: 'ReportItem Count'
                },
                min: 0
            },
            rangeSelector: {
                buttons: [{
                    count: 10,
                    type: 'minute',
                    text: '1M'
                }, {
                    count: 5,
                    type: 'hour',
                    text: '5H'
                }, {
                    type: 'all',
                    text: 'All'
                }],
                enabled: true,
                selected: 0
            },

            /*          tooltip: {
             //	useHTML: true,
             headerFormat: '<b>{series.name}</b><br>',
             pointFormat: '{point.x:%e %b %H:%M},count:{point.y} '
             },
             */
            tooltip: {
                useHTML: true,
                //    headerFormat: '{point.key}<table>',
                headerFormat: '{point.key}<table>',
                pointFormat: '<tr><td style="color: {series.color}"><b>({series.name}) ReportItems={point.y}</b> </td>',
                footerFormat: '</table>'
            },
            series: [{
                name: 'Total: report items',
                data:data
            }]
            ,


            scrollbar: {
                enabled:true,
                barBackgroundColor: 'gray',
                barBorderRadius: 7,
                barBorderWidth: 0,
                buttonBackgroundColor: 'gray',
                buttonBorderWidth: 0,
                buttonArrowColor: 'yellow',
                buttonBorderRadius: 7,
                rifleColor: 'yellow',
                trackBackgroundColor: 'white',
                trackBorderWidth: 1,
                trackBorderColor: 'silver',
                trackBorderRadius: 7
            }
        });
    };

    var url= 'http://localhost/girc/dmis/api/rapid_assessment/report-items/time-line/interval';
    var cumulative = true;
    var data={
        attribute:"id",
        interval:"minute"
    };

    var hc_timeline_data =[
        [1428664140000, 3],
        [1428664260000, 2],
        [1428664320000, 2],
        [1428664440000, 2],
        [1428664560000, 3],
        [1428664680000, 2],
        [1428664800000, 1],
        [1428664920000, 1],
        [1428664980000, 2],
        ];

    $.ajax({
        url:url,
        data:data,
        success:function(data){
            rows=[];
            cumulativeCount=0;
            for(i=0;i<data.length;i++){
                var row=[];
                var count;
                var time;
                time=parseFloat(data[i].unixtime);
                if(cumulative){
                    cumulativeCount+=parseFloat(data[i].count);
                    count=cumulativeCount;
                }else{
                    count=parseFloat(data[i].count);
                }
                row.push(time);
                row.push(count);
                rows.push(row);
            }
            //hc_function('#container','area',hc_timeline_data)
            //var string = JSON.stringify(rows);
           // string.replace (/"/,'');

            hc_function('#container','spline',rows)
            console.log(rows);
        },
        error:function(){
            alert('not good');
        }
    });

    <?php $this->endBlock()?>
</script>
<?php $this->registerJs($this->blocks['test'], $this::POS_READY); ?>

