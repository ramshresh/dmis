<?php
use \yii\web\Request;
return [
    'name'=>'Disaster Management Information System',
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'stream' => [
            'class' => 'common\components\MyStream',// extends 'richweber\twitter\streaming\lib\Stream',
            //'account' => ['kugeospatiallabtest1@gmail.com','kuge0sp@ti@ll@btest1']
            'username' => '3330290638-L1SSDmN3YHflhi96BkewAk9ur3cEdJS9DdAYhU8',
            'password' => 'AEOUj68dNW6HXtNrDwIJqufMEVtE5sCtqY9jwU8CEHyYG',
            'consumerKey' => 'xVHfufwITb5LhpOkbX1Dh9Kgr',
            'consumerSecret' => 'vrSfdcVz7bo78qEnVGdwmUdGiJQ8sA4vanJr1LDMW7HjWqf59B',
            'method' => 'user',
            'format' => 'json',
        ],
        'filterTrackConsumer' => [
            'class' => 'common\components\FilterTrackConsumer',
            'username' => '2903312516-aqImwAzJ7h9X9tUHNgzIGv6AvEBow8eJWxi2iYl',
            'password' => 'SVPnZXns7638XSjeLaAibwg27tRC3ldIEdD3Qh0tPbBNq',
            'consumerKey' => 'wOZVLoFlFIJyRXL8kSO3JqYqe',
            'consumerSecret' => '5mZTEQzgSnPrhWjqNLQNfADV9dMnhEQtp9kqB4hjd9kK3QAhpT',
            'method' => 'filter',
            'format' => 'json',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            //'viewPath' => '@common/mail',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            //'useFileTransport' => true,
            'useFileTransport' => false,
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.gmail.com',
                'username' => 'gircgeomatics@gmail.com',
                'password' => 'passwordgircgeomatics',
                'port' => '587',
                'encryption' => 'tls',
            ],
            'messageConfig' => [
                'from' => ['gircgeomatics@gmail.com' => 'Geospatiallab KU'], // this is needed for sending emails
                'charset' => 'UTF-8',
            ]
        ],
        'authClientCollection' => [
            'class' => 'yii\authclient\Collection',
            'clients' => [
                'facebook' => [
                    'class' => 'yii\authclient\clients\Facebook',
                    'clientId' => '362267747300970',
                    'clientSecret' => 'dbb3570914415338188ccc1179b33903',
                    'scope' => 'email',
                ],
                'google' => [
                    'class' => 'yii\authclient\clients\GoogleOAuth',
                    'clientId' => '777006683516-b0ponfaromu0r578i3jv5bvptl4kpfm3.apps.googleusercontent.com',
                    'clientSecret' => 'D1ktw7aa40ft6tjfVVYa28A2',
                ],

            ],
        ],
        'routing' => [
            'class' => 'common\modules\routing\Module',
        ],
        'user' => [
            //'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'class' => 'common\modules\user\components\User',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'assetManager' => [
            //'linkAssets' => true, //disabled because not working in windows
            'linkAssets' => true,
            // Overriding with Custom jqueryui
            'bundles' => [
                'yii\jui\JuiAsset' => [
                    'sourcePath' => '@common/asset-files/jqueryui/1/11/2/custom',
                    'css' => [
                        'jquery-ui.css',
                    ],
                    'js'=>[
                        'jquery-ui.js',
                    ],
                ],
               /* 'kartik\select2\Select2Asset'=>[
                    'sourcePath'=>'@common/asset-files/select2',
                    'css' => [
                        'select2.min.css',
                    ],
                    'js' => [
                        'select2.min.js',
                    ],
                    'depends' => [
                        'yii\web\YiiAsset',
                        'yii\bootstrap\BootstrapAsset',
                        'yii\web\JqueryAsset',
                    ],
                ],*/
            ]
        ],

    ],
    'modules' => [
        'heritage_assessment' => [
            'class' => 'common\modules\heritage_assessment\Module',
        ],
        'vdc' => [
            'class' => 'common\modules\vdc\Module',
        ],
        'user' => [
            'class' => 'common\modules\user\Module',
            'emailViewPath'=>'@common/modules/user/mail',
            //'emailConfirmation'=>false,
        ],
        'reporting' => [
            'class' => 'common\modules\reporting\Module',
        ],
        'gridview' => [
            'class' => '\kartik\grid\Module'
        ],
        'file' => [
            'class' => 'common\modules\file\Module',
        ],
        'utility' => [
            'class' => 'c006\utility\migration\Module',
        ],
        'tracking' => [
            'class' => 'common\modules\tracking\Module',
        ],
        'rapid_assessment' => [
            'class' => 'common\modules\rapid_assessment\Module',
        ],
        'social_media' => [
            'class' => 'common\modules\social_media\Module',
        ],
        'file_management' => [
            'class' => 'common\modules\file_management\Module',
        ],
        'building_assessment' => [
            'class' => 'common\modules\building_assessment\Module',
        ],
    ],
];
