<?php
/**
 * Created by PhpStorm.
 * User: qiang
 * Date: 5/9/16
 * Time: 4:44 PM
 */


namespace frontend\assets;

use yii\web\AssetBundle;

class HealthAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'frontend/web/css/health/style.css',
    ];
    public $js = [
    ];
    public $depends = [
    ];
}
