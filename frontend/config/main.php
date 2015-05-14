<?php

$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

// {{{ Removing frontend/web from url @see http://www.yiiframework.com/wiki/755/how-to-hide-frontend-web-in-url-addresses-on-apache/*/
use \yii\web\Request;
$baseUrlBackend = str_replace('/frontend/web', '/admin', (new Request)->getBaseUrl());// also add ['vomponents']['request'] 'baseUrl' => $baseUrl,
$baseUrl = str_replace('/frontend/web', '', (new Request)->getBaseUrl());// also add ['vomponents']['request'] 'baseUrl' => $baseUrl,

//}}} ./Removing frontend/web from url

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'request' => [
            'baseUrl' => $baseUrl,
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'RViWfrrd176OveFUGaZt2MOILbofx_Bu',
        ],
        'urlManagerBackEnd' =>[
            'class'=>'yii\web\UrlManager',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'baseUrl' => $baseUrlBackend,
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
        'test-tabular-input' => [
            'class' => 'frontend\modules\testtabularinput\Module',
        ],
        'rapid_assessment' => [
            'class' => 'frontend\modules\rapid_assessment\Module',
        ],
    ],
    'params' => $params,
];
