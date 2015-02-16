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
            'linkAssets' => true,
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
