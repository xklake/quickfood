<?php

namespace backend\controllers;

use Yii;
use common\models\Product;
use common\models\ProductSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\filters\AccessControl;

/**
 * ProductController implements the CRUD actions for Product model.
 */
class ProductController extends Controller
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
                        'roles' => ['@']
                    ]
                ]
            ],
        ];
    }


    /**
     * Lists all Product models.
     * @return mixed
     */
    public function actionIndex()
    {
        if(!Yii::$app->user->can('viewBlog')) throw new HttpException(403, 'No Auth');

        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Product model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if(!Yii::$app->user->can('viewBlog')) throw new HttpException(403, 'No Auth');

        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Product model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if(!Yii::$app->user->can('createBlog')) throw new HttpException(403, 'No Auth');

        $model = new Product();
        $model->loadDefaultValues();

        if ($model->load(Yii::$app->request->post())) {
            $model->thumb = UploadedFile::getInstance($model, 'thumb');
            $model->image = UploadedFile::getInstance($model, 'image');

            if ($model->validate()) {
                if ($model->thumb != null) {
                    $thumb = Yii::$app->params['blogUploadPath'] . date('Ymdhis') . rand(1000, 9999) . '.' . $model->thumb->extension;
                    $model->thumb->saveAs(Yii::getAlias('@frontend/web') . DIRECTORY_SEPARATOR . $thumb);
                    $model->thumb = $thumb;
                }

                if ($model->image != null){
                    $image = Yii::$app->params['blogUploadPath'] . date('Ymdhis') . rand(1000, 9999) . '.' . $model->image->extension;
                    $model->image->saveAs(Yii::getAlias('@frontend/web') . DIRECTORY_SEPARATOR . $image);
                    $model->image = $image;
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
     * Updates an existing Product model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        if(!Yii::$app->user->can('updateBlog')) throw new HttpException(403, 'No Auth');

        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $model->thumb = UploadedFile::getInstance($model, 'thumb');
            $model->image = UploadedFile::getInstance($model, 'image');

            if ($model->validate()) {
                if ($model->thumb) {
                    $thumb = Yii::$app->params['blogUploadPath'] . date('Ymdhis') . rand(1000, 9999) . '.' . $model->thumb->extension;
                    $model->thumb->saveAs(Yii::getAlias('@frontend/web') . DIRECTORY_SEPARATOR . $thumb);
                    $model->thumb = $thumb;
                }

                if ($model->image) {
                    $image = Yii::$app->params['blogUploadPath'] . date('Ymdhis') . rand(1000, 9999) . '.' . $model->image->extension;
                    $model->image->saveAs(Yii::getAlias('@frontend/web') . DIRECTORY_SEPARATOR . $image);
                    $model->image = $image;
                }

                $model->save(false);

                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('update', [
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
     * Deletes an existing Product model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if(!Yii::$app->user->can('deleteBlog')) throw new HttpException(403, 'No Auth');

        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Product model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Product the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Product::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
