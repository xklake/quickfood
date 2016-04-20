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

        $theme = $this->setting->get('themeName');

        if(!isset($theme)){
            $theme = 'default';
        }

        if(file_exists($this->prefix.'/template/'.$theme) && file_exists($this->prefix. '/template/' . $theme . '/views')) {
            $this->setViewPath($this->prefix . '/template/' . $theme . '/views');
            $this->setLayoutPath($this->prefix . '/template/' . $theme . '/layouts');
        } else {
            $this->setViewPath($this->prefix .'/template/default/views');
            $this->setLayoutPath($this->prefix .'/template/default/layouts');
        }
    }
}