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
                'label' => Yii::t('app', 'Widgets'),
                'url' => ['#'],
                'icon' => 'fa-dashboard',
                'options' => [
                    'class' => 'treeview',
                ],

                'items' => [
                    [
                        'label' => Yii::t('app', 'Banner'),
                        'url' => ['/banner'],
                        'icon' => 'fa fa-cog',
                    ],
                    [
                        'label' => Yii::t('app', 'Block'),
                        'url' => ['/block'],
                        'icon' => 'fa fa-user',
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
                        'icon' => 'fa fa-user',
                    ],
                    [
                        'label' => Yii::t('app', 'Role'),
                        'url' => ['/auth'],
                        'icon' => 'fa fa-lock',
                    ],
                    [
                        'label' => Yii::t('app', 'Manage Backup'),
                        'url' => ['/backuprestore'],
                        'icon' => 'fa fa-lock',
                    ],
                ],
            ],
        ]
    ]
);