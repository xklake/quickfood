<?php
namespace backend\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use common\models\LoginForm;
use yii\filters\VerbFilter;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */

    /*
     *  public function init(){

        Parent::init();

        if(isset(Yii::$app->params['blogTheme']) && file_exists(Yii::getAlias('@frontend').'/template/'.Yii::$app->params['blogTheme'])){
                if(file_exists(Yii::getAlias('@backend').'/template/'.Yii::$app->params['blogTheme'].'/views')){
                    Yii::$app->setViewPath('@backend/template/'.Yii::$app->params['blogTheme'].'/views');
                    Yii::$app->setLayoutPath('@backend/template/'.Yii::$app->params['blogTheme'].'/layouts');
                }else {
                    Yii::$app->setViewPath('@backend/template/default/views');
                    Yii::$app->setLayoutPath('@backend/template/default/layouts');
                }
        }else {
            Yii::$app->setViewPath('@backend/template/default/views');
            Yii::$app->setLayoutPath('@backend/template/default/layouts');
        }
    }
    */


    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionError(){
        $this->layout = 'main';

        return $this->render('error', []);
    }

    public function actionLogin()
    {
        $this->layout = 'guest';

        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
