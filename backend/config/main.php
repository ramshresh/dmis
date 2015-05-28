<?php

$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);
// {{{ Removing backend/web from url @see http://www.yiiframework.com/wiki/755/how-to-hide-frontend-web-in-url-addresses-on-apache/*/
use \yii\web\Request;
$baseUrlFrontend = str_replace('/backend/web', '/', (new Request)->getBaseUrl());// also add ['vomponents']['request'] 'baseUrl' => $baseUrl,
$baseUrlApi = str_replace('/api/web', '/api', (new Request)->getBaseUrl());// also add ['vomponents']['request'] 'baseUrl' => $baseUrl,
$baseUrl = str_replace('/backend/web', '/admin', (new Request)->getBaseUrl());// also add ['vomponents']['request'] 'baseUrl' => $baseUrl,
//}}} ./Removing backend/web from url

return [
    'id' => 'GIRC-Admin',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [],
    'components' => [
       /* 'view' => [
            'theme' => [
                'pathMap' => [
                    '@app/views' => '@vendor/ramshresh/yii2-adminlte-asset/example-views/yiisoft/yii2-app'
                ],
            ],
        ],*/
        'request' => [
            'baseUrl' => $baseUrl,
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'k69dPn6pHcjC0eeXjFll7xpwYI0XUb6U',
        ],
        'urlManagerFrontEnd' => [
            'class'=>'yii\web\UrlManager',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'baseUrl' => $baseUrlFrontend,
        ],
        'urlManagerApi' => [
            'class'=>'yii\web\UrlManager',
            'baseUrl' => $baseUrlApi,
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
            ],
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
