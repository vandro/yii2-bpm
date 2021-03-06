<?php

namespace common\modules\entity\backend\controllers;

use Yii;
use yii\filters\AccessControl;
use common\modules\entity\common\models\NodeActionRoleLink;
use common\modules\entity\common\models\NodeActionRoleLinkSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use common\modules\entity\common\actions\CreateAction;
use common\modules\entity\common\actions\UpdateAction;
use common\modules\entity\common\actions\DeleteAction;

/**
 * NarLinkController implements the CRUD actions for NodeActionRoleLink model.
 */
class NarLinkController extends Controller
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
//            'access' => [
//                'class' => AccessControl::className(),
//                'rules' => [
////                    [
////                        'actions' => ['index', 'view'],
////                        'allow' => true,
////                    ],
//                    [
//                        'actions' => ['index', 'view', 'create', 'update', 'delete'],
//                        'allow' => true,
//                        'roles' => ['@'],
//                    ],
//                ],
//            ],
        ];
    }

    public function actions()
    {
        return [
            'create' => [
                'class' => CreateAction::className(),
                'parent_id' => Yii::$app->request->get('parent_id'),
                'tab' => 3,
                'redirect_url' => 'process-nodes/view',
                'modelClass' => NodeActionRoleLink::className(),
                'parent_id_filed' => 'node_id',
            ],
            'update' => [
                'class' => UpdateAction::className(),
                'id' => Yii::$app->request->get('id'),
                'tab' => 3,
                'redirect_url' => 'process-nodes/view',
                'modelClass' => NodeActionRoleLink::className(),
                'parent_id_filed' => 'node_id',
            ],
            'delete' => [
                'class' => DeleteAction::className(),
                'id' => Yii::$app->request->get('id'),
                'tab' => 3,
                'redirect_url' => 'process-nodes/view',
                'modelClass' => NodeActionRoleLink::className(),
                'parent_id_filed' => 'node_id',
            ]
        ];
    }

    /**
     * Lists all NodeActionRoleLink models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new NodeActionRoleLinkSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single NodeActionRoleLink model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id, $tab = 1)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
            'tab' => $tab,
        ]);
    }

    /**
     * Creates a new NodeActionRoleLink model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new NodeActionRoleLink();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing NodeActionRoleLink model.
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
     * Deletes an existing NodeActionRoleLink model.
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
     * Finds the NodeActionRoleLink model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return NodeActionRoleLink the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = NodeActionRoleLink::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
