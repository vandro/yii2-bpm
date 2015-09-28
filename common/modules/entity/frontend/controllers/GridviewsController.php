<?php

namespace common\modules\entity\frontend\controllers;

use Yii;
use common\modules\entity\common\models\permission\Gridviews;
use common\modules\entity\common\models\permission\GridviewsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * GridviewsController implements the CRUD actions for Gridviews model.
 */
class GridviewsController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
//                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Gridviews models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new GridviewsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Gridviews model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id, $tab = 1)
    {
        $actionName = Yii::$app->cache->get('action'.Yii::$app->user->id);
        $actionName = !empty($actionName)?$actionName:'active';

        return $this->render('view', [
            'model' => $this->findModel($id),
            //'actionName' => Yii::$app->request->get('action'),
            'tab' => $tab,
            'actionName' => $actionName,
        ]);
    }

    /**
     * Creates a new Gridviews model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Gridviews();
        $model->user_id = Yii::$app->user->id;

        $actionName = Yii::$app->cache->get('action'.Yii::$app->user->id);
        $actionName = !empty($actionName)?$actionName:'active';

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id, 'action' => Yii::$app->request->get('action')]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'actionName' => $actionName,
            ]);
        }
    }

    /**
     * Updates an existing Gridviews model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $actionName = Yii::$app->cache->get('action'.Yii::$app->user->id);
        $actionName = !empty($actionName)?$actionName:'active';

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id, 'action' => Yii::$app->request->get('action')]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'actionName' => $actionName,
            ]);
        }
    }

    /**
     * Deletes an existing Gridviews model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['tasks-cart/'.Yii::$app->request->get('action')]);
    }

    /**
     * Finds the Gridviews model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Gridviews the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Gridviews::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
