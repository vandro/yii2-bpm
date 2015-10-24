<?php

namespace common\modules\entity\frontend\controllers;

use backend\models\User;
use common\helpers\DebugHelper;
use common\modules\entity\common\components\TaskAccessRule;
use common\modules\entity\common\models\TasksCart;
use Yii;
use common\modules\entity\common\models\ProcessNodes;
use common\modules\entity\common\models\ProcessNodesSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ProcessNodesController implements the CRUD actions for ProcessNodes model.
 */
class NodesCartController extends Controller
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
//                'only' => ['view'],
//                'rules' => [
//                    [
//                        'actions' => ['view'],
//                        'allow' => true,
//                        'matchCallback' => function ($rule, $action) {
//                            $node = $this->findModel(Yii::$app->request->get('id'));
//                            $user = User::findOne(Yii::$app->user->id);
//                            foreach($node->viewRoleLinks as $roleLink){
//                                if($roleLink->role_id == $user->role){
//                                    return true;
//                                }
//                            }
//                            return false;
//                        }
//                    ],
//                ],
//            ],
        ];
    }

    public $layout = 'main';

    /**
     * Lists all ProcessNodes models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProcessNodesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ProcessNodes model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id, $task_id, $prevision_node_id = null)
    {
        $node = $this->findModel($id);
        $user = \common\modules\entity\common\models\permission\User::findOne(Yii::$app->user->id);
        // Обработка условий ноды Начало
        if($node->is_automatic()){
            $nextActionId = $node->getNextActionId($task_id);
            $actionId = ($nextActionId != false) ? $nextActionId : $node->getAutomaticActionId();
            return $this->redirect(['actions-cart/form',
                'id' => $actionId,
                'task_id' => $task_id,
                'prevision_node_id' => $prevision_node_id,
            ]);
        } else {
            $task = TasksCart::findOne($task_id);
            if($user->hasViewAccess($node)) {
                return $this->render('view', [
                    'model' => $node,
                    'task_id' => $task_id,
                    'task' => $task,
                ]);
            }else{
                // Переход на конечную ноду
                return $this->redirect(['view',
//                    'id' => $task->process->lastNode->id,
                    'id' => $task->process->inactiveNode->id,
                    'task_id' => $task_id,
                    'prevision_node_id' => $task->current_node_id,
                ]);
            }
        }
        // Обработка условий ноды Конец

//        if($node->is_automatic()){
//            return $this->redirect(['actions-cart/form',
//                'id' => $node->getAutomaticActionId(),
//                'task_id' => $task_id,
//                'prevision_node_id' => $prevision_node_id,
//            ]);
//        }else{
//            $task = TasksCart::findOne($task_id);
//            if($user->hasViewAccess($node)) {
//
//                return $this->render('view', [
//                    'model' => $node,
//                    'task_id' => $task_id,
//                    'task' => $task,
//                ]);
//            }else{
//                // Переход на конечную ноду
//                return $this->redirect(['view',
//                    'id' => $task->process->lastNode->id,
//                    'task_id' => $task_id,
//                    'prevision_node_id' => $task->current_node_id,
//                ]);
//            }
//        }
    }

    /**
     * Creates a new ProcessNodes model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ProcessNodes();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing ProcessNodes model.
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
     * Deletes an existing ProcessNodes model.
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
     * Finds the ProcessNodes model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ProcessNodes the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ProcessNodes::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
