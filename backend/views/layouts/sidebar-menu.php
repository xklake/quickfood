<?php
use common\widgets\Menu;

echo Menu::widget(
    [
        'options' => [
            'class' => 'sidebar-menu'
        ],
        'items' => [
            [
                'label' => Yii::t('app', 'Dashboard'),
                'url' => Yii::$app->homeUrl,
                'icon' => 'fa-dashboard',
                'active' => Yii::$app->request->url === Yii::$app->homeUrl
            ],

            [
                'label' => Yii::t('app', 'Blog'),
                'url' => ['#'],
                'icon' => 'fa-file-text-o',
                'options' => [
                    'class' => 'treeview',
                ],

                'items' => [
                    [
                        'label' => Yii::t('app', 'Catalog'),
                        'url' => ['/blog/blog-catalog'],
                        'icon' => 'fa fa-list-ul'
                    ],
                    [
                        'label' => Yii::t('app', 'Post'),
                        'url' => ['/blog/blog-post'],
                        'icon' => 'fa fa-file-text-o'
                    ],
                    [
                        'label' => Yii::t('app', 'Comment'),
                        'url' => ['/blog/blog-comment'],
                        'icon' => 'fa fa-commenting-o'
                    ],
                    [
                        'label' => Yii::t('app', 'Tag'),
                        'url' => ['/blog/blog-tag'],
                        'icon' => 'fa fa-tag'
                    ],
                ],
            ],
            [
                'label' => Yii::t('app', 'Widgets'),
                'url' => ['#'],
                'icon' => 'fa-plug',
                'options' => [
                    'class' => 'treeview',
                ],

                'items' => [
                    [
                        'label' => Yii::t('app', 'Banner'),
                        'url' => ['/banner'],
                        'icon' => 'fa fa-picture-o',
                    ],
                    [
                        'label' => Yii::t('app', 'Text Block'),
                        'url' => ['/text-block'],
                        'icon' => 'fa fa-pencil-square-o',
                    ],

                    [
                        'label' => Yii::t('app', 'Html Block'),
                        'url' => ['/html-block'],
                        'icon' => 'fa fa-html5',
                    ],

                    [
                        'label' => Yii::t('app', 'Product'),
                        'url' => ['/product'],
                        'icon' => 'fa fa-cart-plus',
                    ],
                ],
            ],
            [
                'label' => Yii::t('app', 'System'),
                'url' => ['#'],
                'icon' => 'fa fa-cog',
                'options' => [
                    'class' => 'treeview',
                ],
                'items' => [
                    [
                        'label' => Yii::t('app', 'Setting'),
                        'url' => ['/setting'],
                        'icon' => 'fa fa-cog',
                    ],
                    [
                        'label' => Yii::t('app', 'User'),
                        'url' => ['/user/index'],
                        'icon' => 'fa fa-users',
                    ],
                    [
                        'label' => Yii::t('app', 'Role'),
                        'url' => ['/auth'],
                        'icon' => 'fa fa-lock',
                    ],
                    [
                        'label' => Yii::t('app', 'Database'),
                        'url' => ['/backuprestore'],
                        'icon' => 'fa fa-database',
                    ],
                ],
            ],
        ]
    ]
);