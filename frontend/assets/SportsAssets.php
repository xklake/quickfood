<?php
/**
 * Created by PhpStorm.
 * User: qiang
 * Date: 5/23/16
 * Time: 3:40 PM
 */

namespace frontend\assets;
use yii\web\AssetBundle;


class SportsAssets extends AssetBundle
{
    //public $basePath = '@webroot';
    public $sourcePath = '@frontend/template/sports/assets';

    public $css = [
        'css/main.css',
        'css/bootstrap.min.css',
        'css/bootstrap-theme.css',
        'css/font-awesome.min.css',
    ];

    public $js = [
        'js/headroom.min.js',
        'js/html5shiv.js',
        'js/jQuery.headroom.min.js',
        'js/respond.min.js',
        'js/template.js'
    ];
    public $depends = [
    ];

}
