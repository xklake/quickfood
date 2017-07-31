<?php
/**
 * Created by PhpStorm.
 * User: qiang
 * Date: 06/09/16
 * Time: 3:40 PM
 */
namespace frontend\web\template\acura;
use yii;
use yii\web\AssetBundle;


class AcuraAssets extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '/acura/assets';


    public $css = [
        'css/bootstrap.min.css',
        //'css/font-awesome.css',
        'css/fancybox/jquery.fancybox.css',
        'css/flexslider.css',
        'css/style.css',
        //'css/prettyPhoto.css',
        //'css/animate.min.css',
        //'css/responsive.css',
        //'css/scrolling-nav.css',
        //'css/main.css',
    ];

    public $js = [
        'js/jquery.easing.1.3.js',
        'js/bootstrap.min.js',
        'js/jquery.fancybox.pack.js',
        'js/jquery.fancybox-media.js',  
        'js/jquery.flexslider.js',
        'js/animate.js',
        'js/modernizr.custom.js',
        'js/jquery.isotope.min.js',
        'js/jquery.magnific-popup.min.js',
        'js/animate.js',
        'js/custom.js', 
        'js/jqBootstrapValidation.js', 
    ];

    public $depends = [
        //'yii\web\YiiAsset',
        'yii\web\JqueryAsset',
    ];

    public function init()
    {
        if($this->baseUrl != null){
            $this->baseUrl = Yii::$app->urlManager->getHostInfo().$this->baseUrl;
        }
        parent::init();
    }
}
