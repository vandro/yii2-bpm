<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\modules\epigu\models\ActionHandlerLink */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Action Handler Link',
]) . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Action Handler Links'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="action-handler-link-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
