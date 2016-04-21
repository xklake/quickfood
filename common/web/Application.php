<?php
/**
 * Created by PhpStorm.
 * User: qiang
 * Date: 4/19/16
 * Time: 5:17 PM
 */

namespace yii\common\web;


class Application extends \yii\web\Application
{
    protected $isBackend = null;
    protected $prefix = null;

    public function isBackend(){
        return $this->isBackend;
    }

    /*
     * read setting from database
     */
    public function initSetting($isBackEnd){
        $this->isBackend = $isBackEnd;

        if($isBackEnd){
            $this->prefix =  \Yii::getAlias("@backend");
        } else {
            $this->prefix =  \Yii::getAlias("@frontend");;
        }

        $this->initTemplate();
    }


    /*
     * read template name from settings of backend
     * */

    public function initTemplate(){
        $template = $this->setting->get('template');
        $theme = $this->setting->get('theme');
        $viewPath = null;

        if(!isset($template)){
            $template = 'default';
        }

        $viewPath  = $this->prefix.'/template/'.$template;

        $this->setViewPath($viewPath . '/views');
        $this->setLayoutPath($viewPath . '/layouts');

        $view = $this->getView();


        if(isset($theme)){
            $config = [
                'class' => 'yii\base\Theme',
                'pathMap'=>[
                    $viewPath => $viewPath . '/theme/'. $theme,
                ],
                'basePath' => $viewPath . '/theme/'. $theme,
            ];

            $themeObj =  \Yii::createObject($config);

            if(isset($themeObj)){
                $view->theme = $themeObj;
            }
        } else {
            //remove any theme from configuration file..
            $view->theme = null;
        }
    }
}