<?php

namespace backend\controllers;

use Yii;
use common\models\Banner;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\UploadedFile;



/**
 * BannerController implements the CRUD actions for Banner model.
 */
class BannerController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
            
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['viewBlog','createBlog','deleteBlog','updateBlog']
                    ]
                ]
            ],
            
        ];
    }

    /**
     * Lists all Banner models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Banner::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Banner model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Banner model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Banner();
        $model->loadDefaultValues();

        if ($model->load(Yii::$app->request->post()))
        {
            $model->image = UploadedFile::getInstance($model, 'image');
            if ($model->validate()) {
                if ($model->image != null) {
                    $bannerName = Yii::$app->params['blogUploadPath'] . date('Ymdhis') . rand(1000, 9999) . '.' . $model->image->extension;
                    $model->image->saveAs(Yii::getAlias('@frontend/web') . DIRECTORY_SEPARATOR . $bannerName);
                    $model->image = $bannerName;
                }
                $model->save(false);

                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Banner model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $oldImage = $model->image;

        if ($model->load(Yii::$app->request->post()))
        {
            $model->image = UploadedFile::getInstance($model, 'image');
            if ($model->validate()) {
                if ($model->image != null) {
                    $ImageName = Yii::$app->params['blogUploadPath'] . date('Ymdhis') . rand(1000, 9999) . '.' . $model->image->extension;
                    $model->image->saveAs(Yii::getAlias('@frontend/web') . DIRECTORY_SEPARATOR . $ImageName);
                    $model->image = $ImageName;
                }else{
                    $model->image = $oldImage;
                }
                $model->save(false);


                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Banner model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Banner model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Banner the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Banner::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
