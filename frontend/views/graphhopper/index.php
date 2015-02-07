<?php
/* @var $this yii\web\View */
//\common\assets\Ol3Asset::register($this);
$assetsBaseUrl_gh=\common\assets\GraphhopperLeafletAsset::register($this)->baseUrl;
$this->title = 'Graphhopper Routing';
?>

<div id="input">
    <div id="input_header">
        <div id="header_img">
            <a class="no_link" href="https://graphhopper.com">
                <img alt="GraphHopper" src="<?=$assetsBaseUrl_gh?>/img/header.png"/>
            </a>
        </div>
        <div id="options">
                    <span id="vehicles">

                    </span>
        </div>
        <form id="locationform">
            <div id="locationpoints">
                <div id="x_pointAdd" class="pointAdd"><img src="<?=$assetsBaseUrl_gh?>/img/point_add.png"/></div>
            </div>
            <div class="clear"> </div>
            <input id="searchButton" type="submit" value="Search">
        </form>
        <div id="export-link" title="Static Link" class="left"><a href="/maps"><img src="<?=$assetsBaseUrl_gh?>/img/link.png"></a></div>
        <div id="gpxExportButton" title="GPX Download"><a href=""><img alt="gpx" src="<?=$assetsBaseUrl_gh?>/img/gpx.png"></a></div>
        <div id="hosting">Powered by <a href='https://graphhopper.com/#directions-api'>GraphHopper API</a></div>
    </div>
    <div class="clear"> </div>
    <div id="info" class="small_text">
    </div>
    <div id="error" class="error">
    </div>

    <div id="footer">
        <div id="link_line">
            <a class="footer-link" href='https://graphhopper.com/#contact'>Contact</a>
            <a class="footer-link" href='https://graphhopper.com/terms.html'>Terms</a>
            <a class="footer-link" href='https://graphhopper.com/privacy.html'>Privacy</a>
        </div>
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

<div id="map">
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
