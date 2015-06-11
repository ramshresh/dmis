<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 1/31/15
 * Time: 7:44 AM
 */

$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);
// {{{ Removing api/web from url @see http://www.yiiframework.com/wiki/755/how-to-hide-frontend-web-in-url-addresses-on-apache/*/
use \yii\web\Request;
use yii\web\Response;

$baseUrlFrontend = str_replace('/api/web', '/', (new Request)->getBaseUrl());// also add ['vomponents']['request'] 'baseUrl' => $baseUrl,
$baseUrlBackend = str_replace('/api/web', '/admin', (new Request)->getBaseUrl());// also add ['vomponents']['request'] 'baseUrl' => $baseUrl,
$baseUrl = str_replace('/api/web', '/api', (new Request)->getBaseUrl());// also add ['vomponents']['request'] 'baseUrl' => $baseUrl,

//}}} ./Removing api/web from url
return [
    'id' => 'app-api',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'api\controllers',
    'bootstrap' => ['log'],
    'modules' => [
        'tracking' => [
            'class' => 'api\modules\tracking\Module'   // here is our tracking modules
        ],
        'reporting' => [
            'class' => 'api\modules\reporting\Module'   // here is our reporting modules
        ],
        'rapid_assessment'=>[
           'class'=>'api\modules\rapid_assessment\Module' ,
           'controllerMap'=>[
               'gallery'=>'ramshresh\yii2\galleryManager\rest\GalleryImageController',
           ]
        ],
        'file_management' => [
            'class' => 'api\modules\file_management\Module',
        ],
        'user'=>[
            'class'=>'api\modules\user\Module',
        ],
        'vdc'=>[
            'class'=>'api\modules\vdc\Module',
        ],
        'building_assessment'=>[
            'class'=>'api\modules\building_assessment\Module',
        ],
        'heritage_assessment'=>[
            'class'=>'api\modules\heritage_assessment\Module',
        ]

    ],
    'components' => [
        'response' => [
            'class' => 'yii\web\Response',
            'format'=>Response::FORMAT_JSON,
            /*'on beforeSend' => function ($event) {
                $response = $event->sender;
                if (!$response->isSuccessful) {
                    $response->data = [
                        'status' => 'error',
                        'msg'=>'server error',
                        'errors' => ['stack_trace'=>$response->data],
                    ];
                    $response->statusCode = 200;
                }
            },*/
        ],

        'request' => [
            'class' => '\yii\web\Request',
            'baseUrl' => $baseUrl,
            'enableCookieValidation' => false,
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ]
        ],
        'user' => [
            'identityClass' => 'common\modules\user\models\User',
            'enableAutoLogin' => false,
            'enableSession'=>false, //is not required but is recommended for RESTful APIs which should be stateless
            'loginUrl'=>null, //  to show a HTTP 403 error instead of redirecting to the login page.
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'urlManagerBackEnd' =>[
            'class'=>'yii\web\UrlManager',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'baseUrl' => $baseUrlBackend,
        ],
        'urlManagerFrontEnd' => [
            'class'=>'yii\web\UrlManager',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'baseUrl' => $baseUrlFrontend,
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'enableStrictParsing' => true,
            'showScriptName' => false,
            'rules' => [
                [
                    'class' => 'yii\rest\UrlRule', 'controller' => ['site'],
                    'pluralize'=>false,
                    'extraPatterns' => [
                        'GET test-url' => 'test-url',
                    ]
                ],
                [
                    'class' => 'yii\rest\UrlRule', 'controller' => ['user/default'],
                    'pluralize'=>false,
                    'extraPatterns' => [
                        'POST register' => 'register',
                        'POST login' => 'login',
                        'POST logout' => 'logout',
                    ]
                ],
                [
                    'class' => 'yii\rest\UrlRule', 'controller' => ['user/user'],
                    'extraPatterns' => [
                        'POST register' => 'register',
                        'POST login' => 'login',
                        'POST logout' => 'logout',
                    ]
                ],
                [
                    'class' => 'yii\rest\UrlRule', 'controller' => ['file_management/upload'],
                    'pluralize'=>false,
                    'extraPatterns' => [
                        'POST file' => 'file',
                    ]
                ],
                [

                    'class' => 'yii\rest\UrlRule',
                    'controller' => [
                        'rapid_assessment/report-item',
                        'rapid_assessment/gallery',
                        'vdc/nepal-vdc',
                    ],
                    'pluralize'=>true,
                    'extraPatterns' => [
                        'GET unique/<property:\w+>' => 'unique',
                        'GET time-line/<type:\w+>' => 'time-line',
                        'GET gallery-images' => 'gallery-images',
                        'GET children' => 'children',
                        'GET impact-summary' => 'impact-summary',
                        'GET need-summary' => 'need-summary',
                        'GET with-query' => 'with-query',
                        'GET spatial-query' => 'spatial-query',
                        'GET get-drop-down-item-names' => 'get-drop-down-item-names',
                        'GET get-drop-down-item-children-names' => 'get-drop-down-item-children-names',
                        'GET attributes' => 'attributes',
                        'GET <id:\d+>/galleries' => 'galleries',
                        'POST item-class' => 'item-class',
                        'POST <model:\w+>/create' => 'create',

                    ]
                ],
                [
                    'class' => 'yii\rest\UrlRule', 'controller' => ['rapid_assessment/report-item-multimedia'],
                    'pluralize'=>true,
                    'extraPatterns' => [
                    ]
                ],
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => [
                        'rapid_assessment/item',
                        'rapid_assessment/item-type',
                        'rapid_assessment/item-child',
                        'rapid_assessment/item-class',

                    ],
                    'pluralize'=>true,
                    'extraPatterns' => [
                        'GET unique/<attribute:\w+>' => 'unique',
                        'GET info' => 'info',
                        'GET attributes' => 'attributes',
                    ]
                ],
                [
                    'class' => 'yii\rest\UrlRule', 'controller' => ['tracking/unique'],
                    'pluralize'=>false,
                    'extraPatterns' => [
                        'GET <property:\w+>/<value:\w+>' => 'index',
                    ],
                ],
                [
                    'class' => 'yii\rest\UrlRule', 'controller' => ['reporting/event'],
                    'extraPatterns' => [
                        'POST test-create' => 'test-create', // 'test' refers to 'actionTestCreate'
                        'POST test-update/{id}' => 'test-update', // 'test' refers to 'actionTestUpdate'
                        'POST test-manage' => 'test-manage', // 'test' refers to 'actionTestManage'
                    ],
                ],
                [
                    'class' => 'yii\rest\UrlRule', 'controller' => ['reporting/item'],
                    'extraPatterns' =>
                        [
                            'GET search' => 'search',
                        ]

                ],
                [
                    'class' => 'yii\rest\UrlRule', 'controller' => ['reporting/report-item'],
                    'extraPatterns' =>
                        [
                            'GET describe-feature-type' => 'describe-feature-type',
                        ]

                ],
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'reporting/item-type',
                    'extraPatterns' =>
                        [
                            'GET search' => 'search',
                            'GET json'=>'json',
                        ]
                ],
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'reporting/item-sub-type',
                    'extraPatterns' => [
                        'GET search' => 'search'
                    ]
                ],
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'reporting/item-child',
                ],
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'tracking/driver',
                    'extraPatterns' => [
                        'GET unique/<property:\w+>' => 'unique',
                        'POST registration' => 'registration'
                    ]
                ],
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'tracking/tracking-driver',
                    'extraPatterns' => [
                        'GET unique/<property:\w+>' => 'unique',
                        'GET info' => 'info',
                        'GET attributes' => 'attributes',
                    ]
                ],

                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'tracking/status',
                    'extraPatterns' => [
                        'GET unique/<property:\w+>' => 'unique',
                        'GET info' => 'info',
                    ]
                ],
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'tracking/location',
                ],
                //////////////////////
                [

                    'class' => 'yii\rest\UrlRule',
                    'controller' => [
                        'building_assessment/building-household',
                    ],
                    'pluralize'=>true,
                    'extraPatterns' => [
                    ]
                ],
                [

                    'class' => 'yii\rest\UrlRule',
                    'controller' => [
                        'heritage_assessment/heritage',
                    ],
                    'pluralize'=>true,
                    'extraPatterns' => [
                            'GET unique/<property:\w+>' => 'unique',
                    ]
                ],
                /////////////////////
            ],


        ],


    ],
    'params' => $params,
];
