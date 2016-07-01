<?php
return [
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=127.0.0.1;dbname=pandacms_mordern',
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
        ],

        /* live db
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=uk14.siteground.eu;dbname=buycnboo_chinasoftware',
            'username' => 'buycnboo_chinaso',
            'password' => 'Liqiang123&',
            'charset' => 'utf8',
        ],*/

        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
    ],
];
