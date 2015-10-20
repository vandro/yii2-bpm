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
            'attributes' => $formModel->columns,
        ])?>

        <?php foreach($formModel->childForms as $childForm){?>
            <?php $childEntity = $childForm->getChildEntity($entity);?>

                <?php if($childForm->getSetting('child-form-view-type') != 'select-table'){?>

                    <?=$childForm->getAddButton();?>

                    <div style="margin-bottom: 10px"></div>

                    <?= $this->render('_childGridView', [
                        'childForm' => $childForm,
                        'entity' => $childEntity,
                    ]) ?>

                    <?= $this->render('childForm', [
                        'childForm' => $childForm,
                        'entity' => $childEntity,
                        'task_id' => $task_id,
                        'node_id' => $node_id,
                        'action_id' => $action_id,
                    ]) ?>

                <?php }else{ ?>

                    <div class="row">
                        <div class="col-md-6">

                            <?= $this->render('_childGridView', [
                                'childForm' => $childForm,
                                'entity' => $childEntity,
                            ]) ?>

                        </div>
                        <div class="col-md-6">

                            <?= $this->render('childTableSelect', [
                                'childForm' => $childForm,
                                'parentEntity' => $entity,
                                'entity' => $childEntity,
                                'task_id' => $task_id,
                                'node_id' => $node_id,
                                'action_id' => $action_id,
                            ])?>

                        </div>
                    </div>

                <?php } ?>

        <?php } ?>
    </div>
<?php } ?>
