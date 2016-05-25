<?php
return [
    'adminEmail' => 'admin@example.com',
    'supportEmail' => 'info@epandaeye.com',
    'user.passwordResetTokenExpire' => 3600,
    'blogTitle' => 'Panda Content Management System',
    'blogTitleSeo' => 'Content Management System',
    'blogFooter' => 'Copyright &copy; ' . date('Y') . ' by epandaeye.com on Yii2. All Rights Reserved.',
    'blogPostPageCount' => '10',
    /*'blogLinks' => [
        'Google' => 'http://www.google.com',
        'Funson86 Blog' => 'http://github.com/funson86/yii2-blog',
    ],*/

    'blogUploadPath' => 'uploads/', //default to frontend/web/upload

    'elfinderDefaultConfig' => [
        'controller' => 'elfinder', //
        'filter'     => 'image',
        'template'      => '<div class="input-group">{input}<span class="input-group-btn">{button}</span></div>',
        'options'       => ['class' => 'form-control'],
        'buttonOptions' => ['class' => 'btn btn-default'],
        'buttonName'    => 'Browser Images'
    ],
];
