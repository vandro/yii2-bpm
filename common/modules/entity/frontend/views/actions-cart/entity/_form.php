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

<?php if($formModel->mode == 'view'){?>
<div class="panel-body">
    <?= DetailView::widget([
    'model' => $entity,
    'attributes' => $formModel->columns,
    ])?>

    <?php foreach($formModel->childForms as $childForm){?>
        <?php $childEntity = $childForm->getChildEntity($entity);?>
        <?=$childForm->getAddButton();?>
        <?=GridView::widget([
            'dataProvider' => $childEntity->search(),
            'columns' => $childForm->columnsForGridView,
        ]);?>
        <?= $this->render('childForm', [
            'childForm' => $childForm,
            'entity' => $childEntity,
            'task_id' => $task_id,
            'node_id' => $node_id,
            'action_id' => $action_id,
        ]) ?>
    <?php } ?>
</div>
<?php } ?>

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
        <?= Html::button('Create' , ['class' => 'btn btn-default', 'onclick' => 'submitForm()']) ?>
    </div>
</div>

<script>
function submitForm()
{
    $('#node-action-form').submit();
}
</script>

