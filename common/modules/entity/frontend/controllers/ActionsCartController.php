<?php

namespace common\modules\entity\frontend\controllers;

use common\helpers\DebugHelper;
use common\modules\entity\common\actions\CreateChildTableElementAction;
use common\modules\entity\common\actions\EntityFilteredFieldApiAction;
use common\modules\entity\common\config\Config;
use common\modules\entity\common\models\permission\User;
use common\modules\entity\common\models\Tasks;
use common\modules\entity\common\models\TasksCart;
use common\modules\entity\common\models\TasksEntitiesLink;
use common\modules\log\models\TaskLog;
use Yii;
use common\modules\entity\common\models\NodesActions;
use common\modules\entity\common\models\NodesActionsSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\modules\entity\common\actions\CreateChildEntityElementAction;
use common\modules\entity\common\actions\CreateChildEntityElementLinkAction;
use common\modules\entity\common\actions\EntityFormAction;
use common\modules\entity\common\actions\EntityFormAction2;


/**
 * NodesActionsController implements the CRUD actions for NodesActions model.
 */
class ActionsCartController extends Controller
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
                'only' => ['view'],
                'rules' => [
                    [
                        'actions' => ['view'],
                        'allow' => true,
                        'matchCallback' => function ($rule, $action) {
                            $node = $this->findModel(Yii::$app->request->get('id'));
                            $user = User::findOne(Yii::$app->user->id);
                            foreach($node->nodeActionRoleLinks as $roleLink){
                                if($roleLink->role_id == $user->role){
                                    return true;
                                }
                            }
                            return false;
                        }
                    ],
                ],
            ],
        ];
    }

    public $layout = 'main';

    public function actions()
    {
        return [
            'form' => [
                'class' => EntityFormAction::className(),
                'action_id' => Yii::$app->request->get('id'),
                'task_id' => Yii::$app->request->get('task_id'),
            ],
            'createChild' => [
                'class' => CreateChildEntityElementAction::className(),
                'params' => Yii::$app->request->post(),
                'action_id' => Yii::$app->request->get('action_id'),
                'task_id' => Yii::$app->request->get('task_id'),
                'form_id' => Yii::$app->request->get('form_id'),
                'redirect_url' => 'form',
            ],
            'createChildLink' => [
                'class' => CreateChildEntityElementLinkAction::className(),
                'params' => Yii::$app->request->post(),
                'action_id' => Yii::$app->request->get('action_id'),
                'task_id' => Yii::$app->request->get('task_id'),
                'form_id' => Yii::$app->request->get('form_id'),
                'parent_id' => Yii::$app->request->get('parent_id'),
                'link_id' => Yii::$app->request->get('link_id'),
                'redirect_url' => 'form',
            ],
            'createChildTableElement' => [
                'class' => CreateChildTableElementAction::className(),
                'params' => Yii::$app->request->post(),
                'action_id' => Yii::$app->request->get('action_id'),
                'task_id' => Yii::$app->request->get('task_id'),
                'form_id' => Yii::$app->request->get('form_id'),
                'redirect_url' => 'form',
            ],
            'items' => [
                'class' => EntityFilteredFieldApiAction::className(),
                'parent_id' => Yii::$app->request->get('parent_id'),
                'entity_type_id' => Yii::$app->request->get('entity_type_id'),
                'key_field' => Yii::$app->request->get('key_field'),
                'value_field' => Yii::$app->request->get('value_field'),
                'filter_field' => Yii::$app->request->get('filter_field'),
            ],
        ];
    }

    /**
     * Lists all NodesActions models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new NodesActionsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single NodesActions model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

//    /**
//     * Displays a single NodesActions model.
//     * @param integer $id
//     * @return mixed
//     */
//    public function actionForm($id, $task_id, $prevision_node_id = null)
//    {
//        $this->layout = 'mainWithNoLeftMenu';
//
//        $action = $this->findModel($id);
//        $task = $this->findTaskModel($task_id);
//        $entity = Yii::$app->modules[Config::MODULE_NAME]->entityFactory->get($action, $task);
//        $user = User::findOne(Yii::$app->user->id);
//
//        if ($this->loggingAction($task, $task->currentNode, $action) && $entity->load(Yii::$app->request->post()) && $entity->save()) {
//
//            if($this->setTasksEntitiesLink($task_id,$entity->id,$action, $task->currentNode, $prevision_node_id)) { // && $action->runHandlers()) {
//
////                $task = $this->findTaskModel($task_id);
//                $nextNodeId = $task->currentNode->getNextNodeId($action);
//
//                if (!empty($nextNodeId)) {
//                    $previsionNodeId = $task->current_node_id;
//                    $task->current_node_id = $nextNodeId;
//
//                    if ($task->save()) {
//
//                        return $this->redirect(['nodes-cart/view',
//                            'id' => $nextNodeId,
//                            'task_id' => $task_id,
//                            'prevision_node_id' => $previsionNodeId,
//                        ]);
//                    }
//                } else {
////                    DebugHelper::printSingleObjectAndDie(['nodes-cart/view', 'id' => $nextNodeId, 'task_id' => $task_id]);
//                    //Завершить обработку заявки.
//                    // Принять (перенести) задачу из таблицы корзины в основную таблицу
//                    // и перенести все сущности из таблиц корзины в основные таблицы соответсвующих сущностей
//                    // Вывести сообщение о принятий
//                    return $this->render('warning', [
//                        'params' => [
//                            'action' => $action->attributes,
//                            'task' => $task->attributes,
//                            'currentNode' => $task->currentNode->attributes,
//                            'entity' => $entity->attributes,
//                            //'role' => $user->attributes,
//                        ]
//                    ]);
//                }
//            }
//        } else {
//            if($user->hasActionAccess($action, $task->currentNode)) {
//                return $this->render('entity/create', [
//                    'formModel' => $action->form,
//                    'entity' => $entity,
//                    'task' => $this->findTaskModel($task_id),
//                    'task_id' => $task_id,
//                    'node_id' => $task->current_node_id,
//                    'action_id' => $id,
//                    'has_file_upload' => $action->getHasFileUploads($task->current_node_id),
//                ]);
//            }else{
//                // Переход на конечную ноду
//                return $this->redirect(['nodes-cart/view',
//                    'id' => $task->process->lastNode->id,
//                    'task_id' => $task_id,
//                    'prevision_node_id' => $task->current_node_id,
//                ]);
//            }
//        }
//    }

    protected function checkUserRole()
    {
//        $user = User::findOne(Yii::$app->user->id);
//        $user->
    }

    /**
     * Creates a new NodesActions model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new NodesActions();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing NodesActions model.
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
     * Deletes an existing NodesActions model.
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
     * Finds the NodesActions model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return NodesActions the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = NodesActions::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Finds the Tasks model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TasksCart the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findTaskModel($id)
    {
        if (($model = TasksCart::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested task does not exist.');
        }
    }

    protected function setTasksEntitiesLink($task_id, $entity_id, $action, $node_id = null, $prev_node_id = null)
    {
        if($action->form->mode != 'update'){
            $model = new TasksEntitiesLink;
            $model->entity_id = $action->form->entity_id;
            $model->task_id = $task_id;
            $model->entity_item_id = $entity_id;
            $model->user_id = Yii::$app->user->id;
    //        $model->node_id = $node_id;
    //        $model->prev_node_id = $prev_node_id;
            if ($model->save()) {
                return true;
            } else {
                return false;
            }
        }else{
            return true;
        }
    }

    protected function loggingAction($task, $node, $action)
    {
        $log = new TaskLog();
        $log->process_id = $task->process_id;
        $log->task_id = $task->id;
        $log->node_id = $node->id;
        $log->action_id = $action->id;
        $log->user_id = Yii::$app->user->id;

        if($log->save()) {
            return true;
        }else {
            return false;
        }
    }
}
