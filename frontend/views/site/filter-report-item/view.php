<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 4/2/2015
 * Time: 11:25 AM
 */
use kartik\date\DatePickerAsset;
use kartik\select2\Select2Asset;
use yii\bootstrap\BootstrapAsset;

/**
 * @var $this yii\web\View
 */
Select2Asset::register($this);
BootstrapAsset::register($this);
DatePickerAsset::register($this);
$jsPosEnd = <<<SCRIPT
	$.fn.pageMe = function(opts){
    var \$this = this,
        defaults = {
            perPage: 7,
            showPrevNext: false,
            numbersPerPage: 5,
            hidePageNumbers: false
        },
        settings = $.extend(defaults, opts);

    var listElement = \$this;
    var perPage = settings.perPage;
    var children = listElement.children();
    var pager = $('.pagination');

    if (typeof settings.childSelector!="undefined") {
        children = listElement.find(settings.childSelector);
    }

    if (typeof settings.pagerSelector!="undefined") {
        pager = $(settings.pagerSelector);
    }

    var numItems = children.size();
    var numPages = Math.ceil(numItems/perPage);

    pager.data("curr",0);

    if (settings.showPrevNext){
        $('<li><a href="#" class="prev_link">«</a></li>').appendTo(pager);
    }

    var curr = 0;
    while(numPages > curr && (settings.hidePageNumbers==false)){
        $('<li><a href="#" class="page_link">'+(curr+1)+'</a></li>').appendTo(pager);
        curr++;
    }

    if (settings.numbersPerPage>1) {
       $('.page_link').hide();
       $('.page_link').slice(pager.data("curr"), settings.numbersPerPage).show();
    }

    if (settings.showPrevNext){
        $('<li><a href="#" class="next_link">»</a></li>').appendTo(pager);
    }

    pager.find('.page_link:first').addClass('active');
    pager.find('.prev_link').hide();
    if (numPages<=1) {
        pager.find('.next_link').hide();
    }
  	pager.children().eq(1).addClass("active");

    children.hide();
    children.slice(0, perPage).show();

    pager.find('li .page_link').click(function(){
        var clickedPage = $(this).html().valueOf()-1;
        goTo(clickedPage,perPage);
        return false;
    });
    pager.find('li .prev_link').click(function(){
        previous();
        return false;
    });
    pager.find('li .next_link').click(function(){
        next();
        return false;
    });

    function previous(){
        var goToPage = parseInt(pager.data("curr")) - 1;
        goTo(goToPage);
    }

    function next(){
        goToPage = parseInt(pager.data("curr")) + 1;
        goTo(goToPage);
    }

    function goTo(page){
        var startAt = page * perPage,
            endOn = startAt + perPage;

        children.css('display','none').slice(startAt, endOn).show();

        if (page>=1) {
            pager.find('.prev_link').show();
        }
        else {
            pager.find('.prev_link').hide();
        }

        if (page<(numPages-1)) {
            pager.find('.next_link').show();
        }
        else {
            pager.find('.next_link').hide();
        }

        pager.data("curr",page);

        if (settings.numbersPerPage>1) {
       		$('.page_link').hide();
       		$('.page_link').slice(page, settings.numbersPerPage+page).show();
    	}

      	pager.children().removeClass("active");
        pager.children().eq(page+1).addClass("active");

    }
};
SCRIPT;
$this->registerJs($jsPosEnd,$this::POS_END);
$jsPosReady=<<<SCRIPT
/**
		queryData={
			"attr_value":[
				{"type":"emergency_situation"},
				{"item_name":"Emergency Situation"},
				{"class_name":"Regional"}
			],
			"date_filter":[
				{"datefilter_from":"2015-02-15 12:00:00","datefilter_to":"2015-02-15 12:00:00"}
			]
		}
	 */
	 var queryData={};
	 var first_search_value;

	 /* General function for ajax call */

	var ajaxFirstCall = function(url,dom){
	$.ajax({
        async: false,
        type: "GET",
        url: url,
        success: function(data) {
				data.forEach(function(entry) {
					$("#"+dom).append('<option value='+entry+'>'+entry+'</option>');
				});
        }
    })
	}

	var ajaxSecondCall = function(url,dom){
	$.ajax({
        async: false,
        type: "GET",
        url: url,
        success: function(data) {
					json_data = data;
					//console.log(data);

					$.each(data, function(key, value){
						//$.each(value, function(_key, _value){

						$("#"+dom).append('<option value='+value.value+'>'+value.value+'</option>');
							console.log(value.value);
						//	console.log(value)
						//})

					});

				}
    })
	}

	 $("#first_search").change ( function () {
		 first_search_value = $("#first_search").val();
		 $("#second_search").html('');



		 ajaxSecondCall('http://116.90.239.21/girc/dmis/api/rapid_assessment/report-items/unique/'+first_search_value+'?_format=json','second_search');
	})


	ajaxFirstCall('http://116.90.239.21/girc/dmis/api/rapid_assessment/report-items/attributes?_format=json','first_search');
		$("#first_search").select2({
			placeholder: "Search By",
			allowClear: true
		});

	  	$("#second_search").select2({
			placeholder: "Select attribute",
			allowClear: true,
			dropdownAutoWidth : true,
			dropdownCssClass : 'bigdrop'
		});

$("#button").click(function(){
		// tilewmsSource.updateParams({'cql_filter':"class_name='Major'"});

		first_value = $("#first_search").val();
		second_value = $("#second_search").val();

	 //  alert($("#first_search").val()+"="+$("#second_search").val());


	//tr = document.createElement('tr');
	//table.appendChild(tr);
	//td = document.createElement('td');
	//tr.appendChild(td);
	//td.appendChild(value.id);


//	var table = $('#records_table');
	table_ = document.getElementById('records_table');
//	table_.setAttribute('class','table')
	table_.innerHTML='';

	var item_name_array = [];

	$.ajax({
        async: false,
        type: "GET",
        url: 'http://116.90.239.21/girc/dmis/api/rapid_assessment/report-items?'+first_value+'='+second_value+'&_format=json',
        success: function(data) {
				console.log(data);
				json_data = data;
				//console.log(JSON.stringify(data));
					//var trHTML = '<tr><th>hello</th><th>Hello again</th><th>hi</th></tr>';
					var trHTML = '<thead><tr><th>Name</th>'
									+'<th>Type</th><th>Location</th>'
									+'</tr></thead>';
			//	count =0;
//console.log	(json_data);
				$.each(json_data,function(key,value){
			//console.log(value.wkt);
		var loc_function=function(){
			try{
				point = value.wkt;
				pt1 = point.slice(point.indexOf('(')+1,point.indexOf(')'));
				//console.log(pt1);
				longitude = pt1.substr(0,pt1.indexOf(' '));
				latitude = pt1.substr(pt1.indexOf(' ')+1);
				//console.log(longitude);
				//console.log(latitude);



				 zoom = function(_long,_lat){
					var pos = ol.proj.transform([parseFloat(_long),parseFloat(_lat) ], 'EPSG:4326', 'EPSG:3857');
					map.getView().setCenter(pos);
					map.getView().setZoom(12);

					try{
						//map.removeOverlay(marker);
						map.getOverlays().clear();
						//alert("hello");
					}
					catch(err){
						alert("Marker not available");
					}

					var marker = new ol.Overlay({
						  position:pos ,
						  positioning: 'center-center',
						  element: $('<img src="img/location.png" >'),
						  stopEvent: false
					});
					map.addOverlay(marker);



				}
		//	final_button = '<button class="btn btn-primary" onclick="zoom('+longitude+','+latitude+')"></button>';
			final_button = '<div style="margin-top:10px;"><icon class="icon-location" onclick="zoom('+longitude+','+latitude+')"></icon></div>';

			}
			catch(err){
				final_button = '';
				//alert(err.message);
			}

			return final_button;
			}


					trHTML += '<tr><td>' + value.item_name + '</td><td>'
							+ value.type + '</td><td>'
							+ loc_function() + '</td></tr>';

					item_name_array.push(value.item_name);
					//	count=count+1;
					//	if(count<6){

					//	}
					//	ids.append(json_data.id);
				})

				$('#records_table').append(trHTML);
				 //count = ["Building damage", "tent", "Fuel", "Fuel", "Fuel", "Building damage"]
				 count = item_name_array
							.reduce(function (acc, curr) {
					  if (typeof acc[curr] == 'undefined') {
						acc[curr] = 1;
					  } else {
						acc[curr] += 1;
					  }

					  return acc;
					}, {});

			//console.log(count);
			//	var count_json = JSON.stringify(count);
			//	console.log(count_json);

			//	var item_name_count = document.getElementById("item_name_count");

				document.getElementById("item_name_count").innerHTML= '';
				$.each(count,function(key,value){

					 li_element = '<li class="list-group-item">'
							+'<span class="badge">'+value+'</span>'
							+key
							+'</li>';


						//   console.log("hello");

					$('#item_name_count').append(li_element);

				})


			//console.log(table);
				//console.log(ids);
        }
    })

});

$("#date-picker").datepicker();
SCRIPT;

$this->registerJs($jsPosReady,$this::POS_READY);
?>



<div class="row">
    <div class="col-md-12">
        <form class="form-inline">
            <div class="form-group">
                <select  id="first_search" class="form-control">
					<option></option>
                </select>
            </div>
            <div class="form-group" >
                <select  id="second_search" class="form-control" style="width:150px;">
				<option></option>
                </select>
            </div>
            <input type="button" id="button" class="btn btn-primary" value="Submit">
        </form>
    </div>
</div>
<hr style="border-heigt:1px;border-color:rgba(57,52,86,0.8)">
<!--<table id="records_table" border='1'></table>-->
<script src="plugins/table_pagination.js"></script>

<style>
    /*.table-responsive {height:180px;}  */
</style>

<div class="row">
    <div class="col-md-12">
        <div class="tabbable">
            <ul class="nav nav-tabs">
                <li class="active" style="font-weight:bold" ><a href="#one" data-toggle="tab">Summary</a></li>
                <li style="font-weight:bold"><a href="#two" data-toggle="tab">Table</a></li>
                
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="one">
                    <ul class="list-group" id="item_name_count">
                    </ul>


                </div>
                <div class="tab-pane" id="two">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-hover" id="records_table">
                                    <tbody id="myTable"></tbody>
                                </table>
                            </div>
                            <div class="col-md-12 text-center">
                                <ul class="pagination" id="myPager"></ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
