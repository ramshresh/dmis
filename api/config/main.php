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

return [
    'id' => 'app-api',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'api\controllers',
    'bootstrap' => ['log'],
    'modules' => [],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'k69dPn6pHcjC0eeXjFll7xpwYI0hjbhblkjhgfcvhbU',
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ]
        ],
        'user' => [
            'identityClass' => 'common\modules\user\models\User',
            'enableAutoLogin' => false,
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
        'urlManager' => [
            'enablePrettyUrl' => true,
            //'enableStrictParsing' => true,
            'showScriptName' => false,
            'rules' => [
                ['class' => 'yii\rest\UrlRule', 'controller' => 'item','extraPatterns' => ['GET search' => 'search']],
                ['class' => 'yii\rest\UrlRule', 'controller' => 'item-type','extraPatterns' => ['GET search' => 'search']],
                ['class' => 'yii\rest\UrlRule', 'controller' => 'item-sub-type','extraPatterns' => ['GET search' => 'search']],

            ],
        ]
    ],
    'params' => $params,
];
