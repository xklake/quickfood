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
            $this->initTemplate();
        }
    }


    /*
     * read template name from settings of backend
     * */

    public function initTemplate(){
        $template = $this->setting->get('template');
        $theme = $this->setting->get('theme');
        $viewPath = null;

        $viewPath  = $this->prefix.'/template/'.$template;
        if(!isset($template)  || !file_exists($viewPath . '/' . $template)){
            $template = 'default';
        }

        $view = $this->getView();

        $blog = $this->getModule('blog');

        if(isset($theme)){
            if(file_exists($viewPath . '/theme/' . $theme . '/views')){
                $blog->setViewPath($viewPath . '/theme/' . $theme . '/views' );
            } else {
                $blog->setViewPath($viewPath . '/views');
            }

            if(file_exists($viewPath . '/theme/' . $theme .'/layouts')){
                $blog->setLayoutPath($viewPath . '/theme/' . $theme .'/layouts');
            }else {
                $blog->setLayoutPath($viewPath . '/layouts');
            }

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
            $blog->setViewPath($viewPath . '/views');
            $blog->setLayoutPath($viewPath . '/layouts');

            //remove any theme from configuration file..
            $view->theme = null;
        }
    }
}