<?php
/**
 * Created by PhpStorm.
 * User: a_niyazov
 * Date: 20.10.2015
 * Time: 10:09
 */
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\modules\upload\widgets\MegaFileUploadWidget;
use yii\widgets\DetailView;
use yii\grid\GridView;
use yii\widgets\Pjax;
?>

<?php if($formModel->mode == 'view'){?>
    <div class="panel-body">
        <?= DetailView::widget([
            'model' => $entity,
            'attributes' => $formModel->columns,
        ])?>

        <?php foreach($formModel->childForms as $childForm){?>
            <?php $childEntity = $childForm->getChildEntity($entity);?>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
            <!--            --><?//=$childForm->getAddButton();?>
                        <?php Pjax::begin(['id' => 'child-grid']); ?>
                            <?php $childEntity = $childForm->getChildEntity($entity);?>
                            <?=GridView::widget([
                                'summary' => '',
                                'dataProvider' => $childEntity->search(null,15),
                                'columns' => $childForm->columnsForGridView,
                            ]);?>
                        <?php Pjax::end(); ?>
                    </div>
                    <div class="col-md-6">
                        <?php if($childForm->getSetting('child-form-view-type') != 'select-table'){?>
                            <?= $this->render('childForm', [
                                'childForm' => $childForm,
                                'entity' => $childEntity,
                                'task_id' => $task_id,
                                'node_id' => $node_id,
                                'action_id' => $action_id,
                            ]) ?>
                        <?php }else{ ?>
                            <?= $this->render('childTableSelect', [
                                'childForm' => $childForm,
                                'parentEntity' => $entity,
                                'entity' => $childEntity,
                                'task_id' => $task_id,
                                'node_id' => $node_id,
                                'action_id' => $action_id,
                            ])?>
                        <?php } ?>
                    </div>
                    <?php } ?>
                </div>
            </div>
    </div>
<?php } ?>
