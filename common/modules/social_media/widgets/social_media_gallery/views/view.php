<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 3/11/2015
 * Time: 12:11 PM
 */
use common\assets\JqueryBlueimpGalleryAsset;

JqueryBlueimpGalleryAsset::register($this);
?>

<div id="blueimp-gallery" class="blueimp-gallery">
    <!-- The container for the modal slides -->
    <div class="slides"></div>
    <!-- Controls for the borderless lightbox -->
    <h3 class="title"></h3>
    <a class="prev"><icon class="icon-chevron-left"></icon></a>
    <a class="next"><icon class="icon-chevron-right"></icon></a>
    <a class="close"><icon class="icon-close"></icon></a>
    <a class="play-pause"></a>
    <ol class="indicator"></ol>
    <!-- The modal dialog, which will be used to wrap the lightbox content -->
    <div class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" aria-hidden="true">&times;</button>
                    <!--<h4 class="modal-title"></h4>-->
                </div>
                <div class="modal-body next"></div>
                <div class="modal-footer">
                    <h4 class="modal-title" style="text-align: center;font-style: italic;color:rgb(57,52,86);"></h4>
                    <button type="button" class="btn btn-default pull-left prev">
                        <i class="glyphicon glyphicon-chevron-left"></i>
                        Previous
                    </button>
                    <button type="button" class="btn btn-primary next">
                        Next
                        <i class="glyphicon glyphicon-chevron-right"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<!--<div class="container">-->
    <!--<div class="row">-->
        <div class="col-md-12">
          <!--  <h3>Tabs</h3>-->
            <!-- tabs -->
            <div class="tabbable">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#one" data-toggle="tab">Facebook</a></li>
                    <li><a href="#two" data-toggle="tab">Twitter</a></li>
                    <li><a href="#twee" data-toggle="tab">Web & Mobile</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="one" >
						<div id="links_fb" style="overflow-x:scroll;overflow-y:hidden;height:auto;white-space:nowrap;padding:1em;"></div>
					</div>
                    <div class="tab-pane" id="two">
                        <div id="links_twitter" style="overflow-x:scroll;overflow-y:hidden;height:auto;white-space:nowrap;padding:1em;"></div>
					</div>
                    <div class="tab-pane" id="twee">
                        <div id="links_rapid_assessment" style="overflow-x:scroll;overflow-y:hidden;height:auto;white-space:nowrap;padding:1em;"></div>
					</div>
                </div>
            </div>
            <!-- /tabs -->

        </div>
          <!--</div>--><!-- /row -->

<!--</div>-->

<?php
$jsReady = <<<JS
  function sendMyAjaxTwitter(URL_address){
            $.ajax({
                type: 'GET',
                url: URL_address,
                success: function (data) {

                    var img_thumbnails =document.getElementById("links_twitter");

                   obj_data=eval(data);
                    $.each(obj_data, function(count, item) {
                        img_title = obj_data[count][1];
                        img_src = obj_data[count][0];

                        var img_anchor = document.createElement('a');
                        img_anchor.href = img_src;
                        img_anchor.title = img_title;
                        img_anchor.setAttribute('data-gallery', '');

                        var img_img = document.createElement('img');
                        img_img.src = img_src;
                        img_img.alt = img_title ;
                        img_img.setAttribute('style','height:13em;width:auto;padding:2px;margin:2px;');
                        img_anchor.appendChild(img_img);

                        img_thumbnails.appendChild(img_anchor);

                    })
                },
                error:function(){
             //       alert('error in the code');
                }
            });
        }
        function sendMyAjaxFb(URL_address){
            $.ajax({
                type: 'GET',
                url: URL_address,
                /* data: {
                 answer_service: answer,
                 expertise_service: expertise,
                 email_service: email,
                 },
                 */

                success: function (data) {
                    //  console.log(JSON.stringify(data));
                    /* var img_thumbnails = document.createElement("div");
                     img_thumbnails.id="links";*/
                    var img_thumbnails =document.getElementById("links_fb");

                    $.each(data.data, function(count, item) {
                        var fb_image = this;
                        var img_title = fb_image.name;

                        try {
                            var img_src = fb_image.images[1].source;
                        }
                        catch(err) {
                            var img_src = fb_image.images[3].source;
                        }
                        var img_anchor = document.createElement('a');
                        img_anchor.href = fb_image.images[1].source;
                        img_anchor.title = img_title;
                        img_anchor.setAttribute('data-gallery', '');

                        var img_img = document.createElement('img');
                        img_img.src = img_src;
                        img_img.alt = img_title ;
                        img_img.setAttribute('style','height:13em;width:auto;padding:2px;margin:2px;');
                        img_anchor.appendChild(img_img);

                        img_thumbnails.appendChild(img_anchor);
                    })
                    console.log(img_thumbnails);
                }

            });
        }

        function sendMyAjaxRapidAssessment(URL_address,data){
        var data=(data)?data:{};
            $.ajax({
                type: 'GET',
                url: URL_address,
                data:data,
                dataType:'json',
                success: function (data) {

                    var img_thumbnails =document.getElementById("links_rapid_assessment");

                   obj_data=data;
                    $.each(obj_data, function(count, item) {
                        img_title = item.name;
                        img_src = item.src;

                        var img_anchor = document.createElement('a');
                        img_anchor.href = img_src;
                        img_anchor.title = img_title;
                        img_anchor.setAttribute('data-gallery', '');

                        var img_img = document.createElement('img');
                        img_img.src = img_src;
                        img_img.alt = img_title ;
                        img_img.setAttribute('style','height:13em;width:auto;padding:2px;margin:2px;');
                        img_anchor.appendChild(img_img);

                        img_thumbnails.appendChild(img_anchor);

                    })
                },
                error:function(){
             //       alert('error in the code');
                }
            });
        }

        sendMyAjaxFb('http://graph.facebook.com/Kugeolab/photos/uploaded?fields=album,id,name_tags,name,images&limit=30');
        sendMyAjaxTwitter('social_media/twitter-api/get-media');
        sendMyAjaxRapidAssessment('api/rapid_assessment/galleries',{"type":"report_item"});
JS;
$this->registerJs($jsReady,$this::POS_READY);
?>