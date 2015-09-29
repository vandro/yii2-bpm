<?php

namespace common\modules\entity\backend\controllers;

use Yii;
use common\modules\entity\common\models\smi\SmiFoundersLink;
use common\modules\entity\common\models\smi\SmiFoundersLinkSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use common\modules\entity\common\actions\CreateAction;
use common\modules\entity\common\actions\UpdateAction;
use common\modules\entity\common\actions\DeleteAction;

/**
 * SmiFoundersLinkController implements the CRUD actions for SmiFoundersLink model.
 */
class SmiFoundersLinkController extends Controller
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
                'tab' => 3,
                'redirect_url' => 'smi-reestr/view',
                'modelClass' => SmiFoundersLink::className(),
                'parent_id_filed' => 'smi_reestr_id',
            ],
            'update' => [
                'class' => UpdateAction::className(),
                'id' => Yii::$app->request->get('id'),
                'tab' => 3,
                'redirect_url' => 'smi-reestr/view',
                'modelClass' => SmiFoundersLink::className(),
                'parent_id_filed' => 'smi_reestr_id',
            ],
            'delete' => [
                'class' => DeleteAction::className(),
                'id' => Yii::$app->request->get('id'),
                'tab' => 3,
                'redirect_url' => 'smi-reestr/view',
                'modelClass' => SmiFoundersLink::className(),
                'parent_id_filed' => 'smi_reestr_id',
            ]
        ];
    }

    /**
     * Lists all SmiFoundersLink models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SmiFoundersLinkSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single SmiFoundersLink model.
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
     * Creates a new SmiFoundersLink model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new SmiFoundersLink();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing SmiFoundersLink model.
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
     * Deletes an existing SmiFoundersLink model.
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
     * Finds the SmiFoundersLink model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return SmiFoundersLink the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = SmiFoundersLink::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
