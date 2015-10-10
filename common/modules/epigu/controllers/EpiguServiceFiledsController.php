<?php

namespace common\modules\epigu\controllers;

use Yii;
use common\modules\epigu\models\EpiguServiceFileds;
use common\modules\epigu\models\EpiguServiceFiledsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use common\modules\entity\common\actions\CreateAction;
use common\modules\entity\common\actions\UpdateAction;
use common\modules\entity\common\actions\DeleteAction;
/**
 * EpiguServiceFiledsController implements the CRUD actions for EpiguServiceFileds model.
 */
class EpiguServiceFiledsController extends Controller
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
        ];
    }

    public function actions()
    {
        return [
            'create' => [
                'class' => CreateAction::className(),
                'parent_id' => Yii::$app->request->get('parent_id'),
                'tab' => 2,
                'redirect_url' => 'epigu-service/view',
                'modelClass' => EpiguServiceFileds::className(),
                'parent_id_filed' => 'epigu_service_id',
            ],
            'update' => [
                'class' => UpdateAction::className(),
                'id' => Yii::$app->request->get('id'),
                'tab' => 2,
                'redirect_url' => 'epigu-service/view',
                'modelClass' => EpiguServiceFileds::className(),
                'parent_id_filed' => 'epigu_service_id',
            ],
            'delete' => [
                'class' => DeleteAction::className(),
                'id' => Yii::$app->request->get('id'),
                'tab' => 2,
                'redirect_url' => 'epigu-service/view',
                'modelClass' => EpiguServiceFileds::className(),
                'parent_id_filed' => 'epigu_service_id',
            ]
        ];
    }

    /**
     * Lists all EpiguServiceFileds models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new EpiguServiceFiledsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single EpiguServiceFileds model.
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
     * Creates a new EpiguServiceFileds model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new EpiguServiceFileds();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing EpiguServiceFileds model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing EpiguServiceFileds model.
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
     * Finds the EpiguServiceFileds model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return EpiguServiceFileds the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = EpiguServiceFileds::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
