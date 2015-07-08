<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 7/7/2015
 * Time: 2:14 AM
 *
 * https://github.com/samdark/yii2-cookbook/blob/master/book/using-yii-in-third-party-apps.md
 */

namespace common\components\response\formatter;


use yii\helpers\VarDumper;
use yii\web\Response;
use yii\web\ResponseFormatterInterface;

class PhpArrayFormatter implements ResponseFormatterInterface{
    /**
     * Formats the specified response.
     * @param Response $response the response to be formatted.
     */
    public function format($response)
    {
        $response->getHeaders()->set('Content-Type', 'text/php; charset=UTF-8');
        if ($response->data !== null) {
            $response->content = "<?php\nreturn " . VarDumper::export($response->data) . ";\n";
        }
    }

}