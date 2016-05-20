<?php
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;

/*NavBar::begin([
    'brandLabel' => 'My Company',
    'brandUrl' => Yii::$app->homeUrl,
    'options' => [
        'class' => 'navbar-inverse navbar-fixed-top',
    ],
]);*/
$menuItems = [
    [
        'label' => Yii::t('app', 'Home'),
        'url' => ['/site/index']
    ],
    [
        'label' => Yii::t('app', 'Logout') . '(' . Yii::$app->user->identity->username . ')',
        'url' => ['/site/logout'],
        'linkOptions' => ['data-method' => 'post']
    ]
];
echo Nav::widget([
    'options' => ['class' => 'navbar-nav navbar-right'],
    'items' => $menuItems,
]);

$menuItemsMain = [
    [
        'label' => '<i class="fa fa-file-text-o"></i> ' . Yii::t('app', 'Blog'),
        'url' => ['#'],
        'active' => false,
        'items' => [
            [
                'label' => '<i class="fa fa-list-ul"></i> ' . Yii::t('app', 'Catalog'),
                'url' => ['/blog/blog-catalog'],
            ],
            [
                'label' => '<i class="fa fa-file-text-o"></i> ' . Yii::t('app', 'Post'),
                'url' => ['/blog/blog-post'],
            ],
            [
                'label' => '<i class="fa fa-commenting-o"></i> ' . Yii::t('app', 'Comment'),
                'url' => ['/blog/blog-comment'],
            ],
            [
                'label' => '<i class="fa fa-tag"></i> ' . Yii::t('app', 'Tag'),
                'url' => ['/blog/blog-tag'],
            ],
        ],
    ],

    [
        'label' => '<i class="fa fa-plug"></i> ' . Yii::t('app', 'Widgets'),
        'url' => ['#'],
        'active' => false,
        'items' => [
            [
                'label' => '<i class="fa fa-picture-o"></i> ' . Yii::t('app', 'Banner'),
                'url' => ['/banner'],
            ],
            [
                'label' => '<i class="fa fa-puzzle-piece"></i> ' . Yii::t('app', 'Block'),
                'url' => ['/block'],
            ],

        ],
    ],


    [
        'label' => '<i class="fa fa-cog"></i> ' . Yii::t('app', 'System'),
        'url' => ['#'],
        'active' => false,
        'items' => [
            [
                'label' => '<i class="fa fa-cog"></i> ' . Yii::t('app', 'Setting'),
                'url' => ['/setting'],
            ],
            [
                'label' => '<i class="fa fa-user"></i> ' . Yii::t('app', 'User'),
                'url' => ['/user'],
            ],
            [
                'label' => '<i class="fa fa-users"></i> ' . Yii::t('app', 'Role'),
                'url' => ['/auth'],
            ],
            [
                'label' => '<i class="fa fa-database"></i> ' . Yii::t('app', 'Manage Backup'),
                'url' => ['/backuprestore'],
            ],
        ],
    ],

];
echo Nav::widget([
    'options' => ['class' => 'navbar-nav navbar-left'],
    'items' => $menuItemsMain,
    'encodeLabels' => false,
]);

//NavBar::end();

