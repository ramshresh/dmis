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
                'from' => ['gircgeomatics@gmail.com' => 'Admin'], // this is needed for sending emails
                'charset' => 'UTF-8',
            ]
        ],
    ],
];
