<?php
return [
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'pgsql:host=localhost;port=5432;dbname=dmis',
            'username' => 'postgres',
            'password' => 'postgres',
            'charset' => 'utf8',
        ],
    ],
];
