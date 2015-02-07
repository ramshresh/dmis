<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 1/20/15
 * Time: 11:10 AM
 */

namespace common\components;

use Yii;
use yii\base\Component;


class MyFileHelper extends  Component{
    public static function writeFileToWebrootAssets($content,$filename,$extension){
        $webRoot = Yii::$app->getBasePath();
        $path = $webRoot .DIRECTORY_SEPARATOR . 'web' .DIRECTORY_SEPARATOR . 'assets';
        $file = $path. DIRECTORY_SEPARATOR . $filename.'.'.$extension;
        $handle = fopen($file, 'w');
        fwrite($handle,$content);
        fclose($handle);
    }
}