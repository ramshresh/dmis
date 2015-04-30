<?php

Yii::setAlias('common', dirname(__DIR__));
Yii::setAlias('frontend', dirname(dirname(__DIR__)) . '/frontend');
Yii::setAlias('backend', dirname(dirname(__DIR__)) . '/backend');
Yii::setAlias('console', dirname(dirname(__DIR__)) . '/console');
Yii::setAlias('api', dirname(dirname(__DIR__)) . '/api');

// Custom directories
Yii::setAlias('cgi-bin', dirname(dirname(__DIR__)) . '/cgi-bin');
Yii::setAlias('contentRoot', dirname(dirname(__DIR__)) . '/content_root');
Yii::setAlias('uploads', dirname(dirname(__DIR__)) . '/uploads');
Yii::setAlias('images', dirname(dirname(__DIR__)) . '/images');

//----------------------------------------------Sync Assets---------------------------------------------
//---Enable to force copy the asset files---//
//---Disable because linkAsset was set true it creates sym link @see https://github.com/yiisoft/yii2/blob/master/docs/guide/structure-assets.md
/*
    'components'=>[
        ...
        'assetManager' => [
                'linkAssets' => true,
            ],
        ...
    ],
..
 */
//--------------------------------------------OR-------------------------------------------------------------------------------------------------
/*
if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    // ...
    $config['components']['assetManager']['forceCopy'] = true;
}
*/
//----------------------------------------------Sync Assets---------------------------------------------