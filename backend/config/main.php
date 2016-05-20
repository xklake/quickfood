<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [
        'blog' => [
            'class' => 'funson86\blog\Module',
            'controllerNamespace' => 'funson86\blog\controllers\backend'
        ],
        'setting' => [
            'class' => 'funson86\setting\Module',
            'controllerNamespace' => 'funson86\setting\controllers'
        ],
        'auth' => [
            'class' => 'funson86\auth\Module',
            'controllerNamespace' => 'funson86\auth\controllers'
        ],

        'backuprestore' => [
            'class' => '\oe\modules\backuprestore\Module',
            'layout' => '@backend/views/layouts/main',
            'modules' => [
                'gridview' =>  [
                    'class' => '\kartik\grid\Module'
                ]
            ],
        ],
    ],


    'components' => [
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            //'enableStrictParsing' => true,
            'rules' => [
                '<controller:\w+>/<id:\d+>' => '<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
            ],
        ],

        'urlManagerFrontEnd' => [
            'class' => 'yii\web\urlManager',
            'scriptUrl' => '/pandacms/frontend/web', //代替'baseUrl'
            'enablePrettyUrl' => true,
            'showScriptName' => true,

            'rules' => [
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
            'errorAction' => 'site/error',
        ],

        'request'=>[
            'class' => 'common\web\Request',
            'web'=> '/backend/web',
            'adminUrl' => '/admin'
        ],
    ],
    'params' => $params,
    'controllerMap' => [
        'elfinder' => [
            'class' => 'mihaildev\elfinder\PathController',
            'access' => ['@'],
            'root' => [
                'path' => 'uploads', //主目录路径
                'name' => 'Files',
            ],/*
        'watermark' => [
            'source'         => __DIR__.'/logo.png', // Path to Water mark image
            'marginRight'    => 5,          // Margin right pixel
            'marginBottom'   => 5,          // Margin bottom pixel
            'quality'        => 95,         // JPEG image save quality
            'transparency'   => 70,         // Water mark image transparency ( other than PNG )
            'targetType'     => IMG_GIF|IMG_JPG|IMG_PNG|IMG_WBMP, // Target image formats ( bit-field )
            'targetMinPixel' => 200         // Target image minimum pixel size
        ]*/
        ]]
];
