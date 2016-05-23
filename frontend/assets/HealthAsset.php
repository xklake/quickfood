<?php
/**
 * Created by PhpStorm.
 * User: qiang
 * Date: 5/9/16
 * Time: 4:44 PM
 */


namespace frontend\assets;

use yii\web\AssetBundle;
use Yii;

class HealthAsset extends AssetBundle
{
    //public $basePath = '@webroot';
    public $sourcePath = '@frontend/template/health/assets';

    public $css = [
        'css/style.css',
    ];

    public $js = [
        'js/yii.js'
    ];
    public $depends = [
    ];


    /*function __construct(){
        parent::init();

        $css =  '/css/'.Yii::$app->setting->get('template') . '/style.css';
        $this->css[] = $css;
    }*/
}
