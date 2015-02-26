<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
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
            'linkAssets' => false,
            // Overriding with Custom jqueryui
            'bundles' => [ 'yii\jui\JuiAsset' => [
                'sourcePath' => '@common/asset-files/jqueryui/1/11/2/custom',
                'css' => [
                    'jquery-ui.css',
                ],
                'js'=>[
                    'jquery-ui.js',
                ],

            ] ]
        ],
    ],
    'modules' => [
        'user' => [
            'class' => 'common\modules\user\Module',
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
    ],

];
