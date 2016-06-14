<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log', 'blog'],
    'controllerNamespace' => 'frontend\controllers',
    'modules' => [
        'blog' => [
            'class' => 'funson86\blog\Module',
            'controllerNamespace' => 'funson86\blog\controllers\frontend'
        ],
    ],
    'defaultRoute' => 'blog',
    'components' => [
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            //'enableStrictParsing' => true,
            'suffix' => '.html',
            'rules' => [
                'catelog/<id:\d+>' => 'blog/default/catalog',
                'catelog/<id:\d+>/<page:\d+>' => 'blog/default/catalog',

                'coaching/<id:\d+>' => 'blog/default/product',
                'blog/<id:\d+>/<page:\d+>' => 'blog/default/view',
                'blog/<id:\d+>' => 'blog/default/view',

                '<controller:\w+>/<id:\d+>' => '<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
            ],
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

        'errorHandler' => [
            'errorAction' => 'blog/default/error',
        ],

        'request'=>[
            'class' => 'common\web\Request',
            'web'=> '/frontend/web'
        ],

        /*
         * please do not configure theme

        'view' => [
            'theme' => [
                'basePath' => 'red',
                'baseUrl' => 'red',
            ]
        ]*/
    ],
    'params' => $params,
];
