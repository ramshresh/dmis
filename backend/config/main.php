<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);
// {{{ Removing backend/web from url @see http://www.yiiframework.com/wiki/755/how-to-hide-frontend-web-in-url-addresses-on-apache/*/
use \yii\web\Request;
$baseUrl = str_replace('/backend/web', '/admin', (new Request)->getBaseUrl());// also add ['vomponents']['request'] 'baseUrl' => $baseUrl,
//}}} ./Removing backend/web from url

return [
    'id' => 'GIRC-Admin',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [],
    'components' => [
        'request' => [
            'baseUrl' => $baseUrl,
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'k69dPn6pHcjC0eeXjFll7xpwYI0XUb6U',
        ],
        'urlManager' => require(__DIR__ . '/components/urlManager.php'),
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
    ],
    'modules' => [
        'moderate_reporting' => [
            'class' => 'backend\modules\moderate_reporting\Module',
        ],
    ],
    'params' => $params,
];
