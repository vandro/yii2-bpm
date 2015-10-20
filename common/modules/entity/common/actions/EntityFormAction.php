<?php
/**
 * Created by PhpStorm.
 * User: a_niyazov
 * Date: 01.09.2015
 * Time: 16:22
 */
namespace common\modules\entity\common\actions;

use common\helpers\DebugHelper;
use Yii;
use common\modules\entity\common\config\Config;
use common\modules\entity\common\models\TasksCart;
use common\modules\entity\common\models\TasksEntitiesLink;
use common\modules\log\models\TaskLog;
use common\modules\entity\common\models\NodesActions;
use yii\web\NotFoundHttpException;
use common\modules\entity\common\models\permission\User;


class EntityFormAction extends \yii\base\Action
{
    public $action_id;
    public $task_id;
    public $prevision_node_id;

    public function run()
    {
        $this->controller->layout = 'mainWithNoLeftMenu';

        $action = $this->findModel($this->action_id);
        $task = $this->findTaskModel($this->task_id);
//        $entity = Yii::$app->modules[Config::MODULE_NAME]->entityFactory->get($action, $task);
        $entity = $task->getEntityByForm($action->form_id);
        $user = User::findOne(Yii::$app->user->id);

        if($action->form->mode != 'view'){
            return $this->processCreateUpdateModes($task, $action, $entity, $user);
        }else{
            return $this->processViewMode($task, $action, $entity, $user);
        }
    }

    protected function processCreateUpdateModes($task, $action, $entity, $user)
    {
        if ($entity->load(Yii::$app->request->post()) && $entity->save() && $this->loggingAction($task, $task->currentNode, $action)) {
            if($this->setTasksEntitiesLink($this->task_id,$entity->id,$action, $task->currentNode, $this->prevision_node_id)) { // && $action->runHandlers()) {
                $this->goToNextNode($task, $action, $entity);
            }
        } else {
            return $this->render($task, $action, $entity, $user);
        }
    }

    protected function processViewMode($task, $action, $entity, $user)
    {
        if ($this->loggingAction($task, $task->currentNode, $action) && $entity->load(Yii::$app->request->post())) { // && $this->checkChildEntityData($action, $entity) && $action->runHandlers()) {
            $this->goToNextNode($task, $action, $entity);
        } else {
            return $this->render($task, $action, $entity, $user);
        }
    }

    public function render($task, $action, $entity, $user)
    {
        if($user->hasActionAccess($action, $task->currentNode)) {
            return $this->controller->render('complexEntityForm/create', [
                'formModel' => $action->form,
                'entity' => $entity,
                'task' => $this->findTaskModel($this->task_id),
                'task_id' => $this->task_id,
                'node_id' => $task->current_node_id,
                'action_id' => $this->action_id,
                'has_file_upload' => $action->getHasFileUploads($task->current_node_id),
                'controller' => $this->controller,
            ]);
        }else{
            // Переход на конечную ноду
            if(!empty($task->process->lastNode)) {
                return $this->controller->redirect(['nodes-cart/view',
                    'id' => $task->process->lastNode->id,
                    'task_id' => $this->task_id,
                    'prevision_node_id' => $task->current_node_id,
                ]);
            }else{
                $this->controller->layout = 'mainWithNoLeftMenu';
                return $this->controller->render('noLastNodeView', [
                    'params' => [
                        'action' => $action->attributes,
                        'task' => $task->attributes,
                        'currentNode' => $task->currentNode->attributes,
                        'entity' => $entity->attributes,
                    ]
                ]);

            }
        }
    }

    protected function goToNextNode($task, $action, $entity)
    {

        $nextNodeId = $task->currentNode->getNextNodeId($action);

        if (!empty($nextNodeId)) {
            $previsionNodeId = $task->current_node_id;
            $task->current_node_id = $nextNodeId;

            if ($task->save()) {

                return $this->controller->redirect(['nodes-cart/view',
                    'id' => $nextNodeId,
                    'task_id' => $this->task_id,
                    'prevision_node_id' => $previsionNodeId,
                ]);
            }
        } else {
            DebugHelper::printSingleObject([
                'action' => $action->attributes,
                'task' => $task->attributes,
                'currentNode' => $task->currentNode->attributes,
                'entity' => $entity->attributes,
            ]);
            $this->controller->layout = 'mainWithNoLeftMenu';
            return $this->controller->render('warningView', [
                'params' => [
                    'action' => $action->attributes,
                    'task' => $task->attributes,
                    'currentNode' => $task->currentNode->attributes,
                    'entity' => $entity->attributes,
                ]
            ]);
        }
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

    protected function checkChildEntityData($action, $entity)
    {
        foreach($action->form->childForms as $childForm){
            $childElements = $entity->getChildFormData($childForm);
            if(!empty($childElements)){
                return true;
            }else{
                return false;
            }
        }

    }
}