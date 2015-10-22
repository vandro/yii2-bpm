<?php
/**
 * Created by PhpStorm.
 * User: a_niyazov
 * Date: 07.09.2015
 * Time: 11:22
 */
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\modules\upload\widgets\MegaFileUploadWidget;
use yii\widgets\DetailView;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model common\modules\entity\common\models\EntityTypes */
/* @var $form yii\widgets\ActiveForm */
?>


<div class="panel-body">
    <?php $form = ActiveForm::begin([
        'options' => [
            'id' => 'node-action-form',
            'name' => 'node-action-form',
        ]
    ]); ?>
        <?php if($formModel->mode != 'view'){?>
            <?= $formModel->render($form, $entity) ?>
        <?php }else{ ?>
            <div style="display: none;">
                <?= $formModel->render($form, $entity) ?>
            </div>
        <?php } ?>
    <?php ActiveForm::end(); ?>
</div>

<?= $this->render('_view', [
    'formModel' => $formModel,
    'entity' => $entity,
    'task_id' => $task_id,
    'node_id' => $node_id,
    'action_id' => $action_id,
    'has_file_upload' =>  $has_file_upload,
    'controller' => $controller,
]) ?>

<?php if($has_file_upload){?>
    <div class="panel-body">
        <?= MegaFileUploadWidget::widget([
            'taskId' => $task_id,
            'nodeId' => $node_id,
            'actionId' => $action_id,
        ]) ?>
    </div>
<?php } ?>
<div class="panel-footer">
    <div class="form-group">
        <?php if($node_order_status == 'filling'){ ?>
            <?= Html::a('Назад', ['actions-cart/previousNode', 'task_id' => $task_id, 'previous_node_id' => $previous_node_id], ['class' => 'btn btn-default']) ?>
        <?php } ?>
        <?= Html::button('Далее' , ['class' => 'btn btn-default','id' => 'main-submit-button', 'onclick' => 'submitForm()']) ?>
    </div>
</div>

<script>
function submitForm()
{
    $('#node-action-form').submit();
}
function toPreviousNode()
{
    $('#node-action-form').submit();
}
</script>

