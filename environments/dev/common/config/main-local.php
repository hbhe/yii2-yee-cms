<?php
return [
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=yeecms',
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
            'enableSchemaCache' => true,
            'schemaCacheDuration' => 3600,
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.gmail.com',
                'username' => 'yourname@gmail.com',
                'password' => 'yourpassword',
                'port' => '587',
                //'encryption' => 'tls',
                'encryption' => false,
            ],
            'htmlLayout' => '@vendor/yeesoft/yii2-yee-auth/views/mail/layouts/html',
            'textLayout' => '@vendor/yeesoft/yii2-yee-auth/views/mail/layouts/text',
        ],
    ],
];
