<?php
/**
 * Created by PhpStorm.
 * User: a_niyazov
 * Date: 20.10.2015
 * Time: 10:09
 */

use yii\widgets\DetailView;
?>

<?php if($formModel->mode == 'view'){?>
    <div class="panel-body">
        <?= DetailView::widget([
            'model' => $entity,
            'attributes' => $formModel->getColumnsForDetailView($entity),
        ])?>

        <?php foreach($formModel->childForms as $childForm){?>
            <?php $childEntity = $childForm->getChildEntity($entity);?>

                <?php if($childForm->getSetting('child-form-view-type') == 'select-table'){?>

                    <div class="row">
                        <div class="col-md-6">

                            <?= $this->render('_childGridView', [
                                'childForm' => $childForm,
                                'parentEntity' => $entity,
                                'childEntity' => $childEntity,
                                'task_id' => $task_id,
                                'node_id' => $node_id,
                                'action_id' => $action_id,
                            ]) ?>

                        </div>
                        <div class="col-md-6">

                            <?= $this->render('childTableSelect', [
                                'childForm' => $childForm,
                                'parentEntity' => $entity,
                                'childEntity' => $childEntity,
                                'task_id' => $task_id,
                                'node_id' => $node_id,
                                'action_id' => $action_id,
                            ])?>

                        </div>
                    </div>


                <?php }elseif($childForm->getSetting('child-form-view-type') == 'only-child-form'){ ?>

                    <?= $this->render('noModalTypeChildForm', [
                        'childForm' => $childForm,
                        'entity' => $childEntity,
                        'task_id' => $task_id,
                        'node_id' => $node_id,
                        'action_id' => $action_id,
                    ]) ?>

                <?php }elseif($childForm->getSetting('cant-add')){ ?>

                    <?= $this->render('_childGridView', [
                        'childForm' => $childForm,
                        'parentEntity' => $entity,
                        'childEntity' => $childEntity,
                        'task_id' => $task_id,
                        'node_id' => $node_id,
                        'action_id' => $action_id,
                    ]) ?>

                <?php }else{ ?>

                    <?=$childForm->getAddButton();?>

                    <div style="margin-bottom: 10px"></div>

                    <?= $this->render('_childGridView', [
                        'childForm' => $childForm,
                        'parentEntity' => $entity,
                        'childEntity' => $childEntity,
                        'task_id' => $task_id,
                        'node_id' => $node_id,
                        'action_id' => $action_id,
                    ]) ?>

                    <?= $this->render('childForm', [
                        'childForm' => $childForm,
                        'entity' => $childEntity,
                        'task_id' => $task_id,
                        'node_id' => $node_id,
                        'action_id' => $action_id,
                    ]) ?>

                <?php } ?>

        <?php } ?>
    </div>
<?php } ?>
