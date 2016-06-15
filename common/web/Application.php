<?php
/**
 * Created by PhpStorm.
 * User: qiang
 * Date: 4/19/16
 * Time: 5:17 PM
 */
namespace yii\common\web;
use common\models\Banner;
use common\models\HtmlBlock;
use common\models\TextBlock;
use funson86\blog\models\Status;

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
            $this->prefix =  \Yii::getAlias("@frontend/web");;
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

    /****
     * get banner or gallary from db, this could be commonly used by frontend code
     *
     * id can be  a id or can be name
     * if pass a id list then it will return a group of banner otherwise, it will check a matched id or name
     * eg. 	$banner = Yii::$app->getBanners(['1232', 'namd']);
     */
   public function getBanners($id){
       if(!is_array($id)){
           return Banner::find()->where(['status'=> Status::STATUS_ACTIVE])->andWhere(['or', ['id'=> $id], ['name'=>$id]])->one();
       }
       else {
           return Banner::find()->where(['status'=> Status::STATUS_ACTIVE])->andwhere(['or', ['in', 'id', $id], ['in','name', $id]])->all();
       }
    }

    /****
     * get a group of banners from db, this could be commonly used by frontend code
     *
     * $groupid: just a group id or several group via array
     * eg. 	$banner = Yii::$app->getBannerByGroup(123);
     */
    public function getBannerByGroup($groupid){
        if(!is_array($groupid)){
            return Banner::find()->where(['status'=> Status::STATUS_ACTIVE])->andwhere(['groupid'=> $groupid])->all();
        } else {
            return Banner::find()->where(['status'=> Status::STATUS_ACTIVE])->andwhere(['in', 'groupid', $groupid])->all();
        }
    }

    /******
     * as above
     * 	$textbanner = Yii::$app->getTextBlock([1, 2, 3]);
     */
    public function getTextBlock($id){
        if(!is_array($id)){
            return TextBlock::find()->where(['or', ['id'=> $id], ['name'=>$id]])->one();
        } else {
            return TextBlock::find()->where(['or', ['in', 'id',  $id], ['in', 'name', $id]])->all();
        }
    }

    /******
     * as above
     * 	Yii::$app->getHtmlBlock([5, 'test']);
     */
    public function getHtmlBlock($id){
        if(!is_array($id)){
            return HtmlBlock::find()->where(['or', ['id'=> $id], ['name'=>$id]])->one();
        } else {
            return HtmlBlock::find()->where(['or', ['in', 'id',  $id], ['in', 'name', $id]])->all();
        }
    }

    /******
     * as above
     * 	Yii::$app->getHtmlBlock([5, 'test']);
     */
    public function getHtmlBlockContent($id){
        $obj = $this->getHtmlBlock($id);
        if($obj != null){
            return $obj->content;
        }
    }
    /***
     * return the catalog list
     */
    public function getCatalogs(){
        $cats = $this->params['mainMenu'];
        return $cats;
    }
}