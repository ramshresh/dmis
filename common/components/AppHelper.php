<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 4/13/2015
 * Time: 11:26 AM
 */

namespace common\components;

use Yii;
use yii\base\Component;
use yii\web\UrlManager;

class AppHelper extends Component {
    /**
     * @var Array $apps is the array data for available apps;
     * example
     * []
     */

    public $apps;


    public static function getAppUrlToRoute($appName=null,$route=null){


        //$appName = 'backend'; // 'frontend', 'api'
        //$appAlias = 'admin';
        //$appAlias = '';
        //$appWebRoot = 'admin/'; // can be backend/web that has been rewrite by apache
        //$appName = 'frontend';
        //$appAlias = '';
        $appWebRoot = 'admin/'; // can be backend/web that has been rewrite by apache
       // $appWebRoot = ''; // can be backend/web that has been rewrite by apache

        //$route =['user/registration/reset','key'=>'asadasasd9087t67rfgevjbhskjdnfk'];
        /**
         * $appName correspond to alias
         */
        $appAbsoluteBaseUrl = str_replace(Yii::$app->request->getPathInfo(),'',Yii::$app->request->getAbsoluteUrl());
        $frontendAppAbsoluteBaseUrl =preg_replace("/[^\/]\w+\/$/","",$appAbsoluteBaseUrl);
        $backendAppAbsoluteBaseUrl =preg_replace("/[^\/]\w+\/$/","",$appAbsoluteBaseUrl).$appWebRoot;
        $routeAbsoluteUrl = Yii::$app->urlManager->createAbsoluteUrl($route);
        $routePathInfo = str_replace($appAbsoluteBaseUrl,'',$routeAbsoluteUrl);
        $urlAbsolute = $backendAppAbsoluteBaseUrl.'/dmis'.$routePathInfo;
        return $urlAbsolute;
    }
}