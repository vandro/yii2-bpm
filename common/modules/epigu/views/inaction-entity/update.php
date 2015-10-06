<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\modules\epigu\models\InActionEntityLink */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'In Action Entity Link',
]) . ' ' . $model->entityType->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Integration Actions'), 'url' => ['integration-actions/index']];
$this->params['breadcrumbs'][] = ['label' => $model->integrationAction->title, 'url' => ['integration-actions/view', 'id' => $model->integration_action_id, 'tab' => 2]];
$this->params['breadcrumbs'][] = ['label' => $model->entityType->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="in-action-entity-link-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
