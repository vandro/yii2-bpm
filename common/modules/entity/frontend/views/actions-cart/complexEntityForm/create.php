<?php
/**
 * Created by PhpStorm.
 * User: a_niyazov
 * Date: 07.09.2015
 * Time: 11:22
 */

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\modules\entity\common\models\EntityTypes */

//$this->title = 'Do Action';
//$this->params['breadcrumbs'][] = ['label' => 'Action', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
$actionLink = $action->getNarLink($node_id);
?>
<?php if($actionLink->getSetting('message')){ ?>
    <?= $this->render('_messageView', [
        'formModel' => $formModel,
        'entity' => $entity,
        'task' => $task,
        'task_id' => $task_id,
        'node_id' => $node_id,
        'action_id' => $action_id,
        'actionLink' => $actionLink,
        'messageType' => $actionLink->getSetting('message-type'),
    ]) ?>
<?php } ?>
<div class="entity-types-create">

    <div class="panel panel-default">
        <div class="panel-heading">
            <h2 class="panel-title"><?= Html::encode($task->process->title) ?> - <?= Html::encode($action->title) ?></h2>
        </div>
        <?= $this->render('_form', [
            'formModel' => $formModel,
            'entity' => $entity,
            'task_id' => $task_id,
            'node_id' => $node_id,
            'action_id' => $action_id,
            'has_file_upload' =>  $has_file_upload,
            'controller' => $controller,
            'node_order_status' =>  $node_order_status,
            'previous_node_id' => $previous_node_id,
            'has_assign_executor' => $has_assign_executor,
        ]) ?>
    </div>
</div>