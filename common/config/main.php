<?php
use \yii\web\Request;
return [
    'name'=>'DMIS',
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'authClientCollection' => [
            'class' => 'yii\authclient\Collection',
            'clients' => [
                'facebook' => [
                    'class' => 'yii\authclient\clients\Facebook',
                    'clientId' => '362267747300970',
                    'clientSecret' => 'dbb3570914415338188ccc1179b33903',
                    'scope' => 'email',
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
    ],
];
