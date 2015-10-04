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
?>
<div class="entity-types-create">

    <div class="panel panel-default">
        <div class="panel-heading">
            <h2 class="panel-title"><?= Html::encode($task->process->title) ?> - <?= Html::encode($entity->entityType->title) ?></h2>
        </div>
        <?= $this->render('_form', [
            'formModel' => $formModel,
            'entity' => $entity,
        ]) ?>
    </div>
</div>