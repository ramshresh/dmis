<?php
/* @var $this yii\web\View */
//\common\assets\Ol3Asset::register($this);
$assetsBaseUrl_gh=\common\assets\GraphhopperLeafletAsset::register($this)->baseUrl;

$this->title = 'Graphhopper Routing';
?>

<div  id="input" style="position:absolute; top:80px;left:5px;">
    <div id="input_header">
        <form id="locationform">
            <div id="locationpoints">
                <div id="x_pointAdd" class="pointAdd"><img src="<?=$assetsBaseUrl_gh?>/img/point_add.png"/></div>
            </div>
            <div class="clear"> </div>
            <input id="searchButton" type="submit" value="Search">
        </form>
    </div>
    <div class="clear"> </div>
    <div id="info" class="small_text">
    </div>
    <div id="error" class="error">
    </div>
    <div id="pointTemplate" class="hidden">
        <div id="{id}_Div" class="pointDiv">
            <img id="{id}_Indicator" class="hidden pointIndicator" src="<?=$assetsBaseUrl_gh?>/img/loading.gif"/>
            <img id="{id}_Flag" class="pointFlag" src="<?=$assetsBaseUrl_gh?>/img/marker-small-green.png"/>
            <input id="{id}_Input" class="pointInput" type="text" placeholder=""/>
            <div class="pointDelete"><img src="<?=$assetsBaseUrl_gh?>/img/point_delete.png"></div>
            <div class="clear"> </div>
            <div id="{id}_ResolveFound" class="pointResolveFound"></div>
            <div id="{id}_ResolveError" class="pointResolveError"></div>
        </div>
    </div>
</div>

<div id="map" style="width: 100%;;" >
</div>

<!-- Piwik -->
<script type="text/javascript">
    PIWIK = false;
    if (PIWIK) {
        var _paq = _paq || [];
        _paq.push(['trackPageView']);
        _paq.push(['enableLinkTracking']);
        (function () {
            var u = (("https:" == document.location.protocol) ? "https" : "http") + "://graphhopper.com/piwik/";
            _paq.push(['setTrackerUrl', u + 'piwik.php']);
            _paq.push(['setSiteId', 1]);
            var d = document, g = d.createElement('script'), s = d.getElementsByTagName('script')[0];
            g.type = 'text/javascript';
            g.defer = true;
            g.async = true;
            g.src = u + 'piwik.js';
            s.parentNode.insertBefore(g, s);
        })();
    }
</script>
<noscript><p><img src="https://graphhopper.com/piwik/piwik.php?idsite=1" style="border:0;" alt="" /></p></noscript>
<!-- End Piwik Code -->
</body>
