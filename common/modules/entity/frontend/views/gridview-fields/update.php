<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\modules\entity\common\models\permission\GridviewFields */
$actionName = Yii::$app->cache->get('action'.Yii::$app->user->id);
$actionName = !empty($actionName)?$actionName:'active';

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Gridview Fields',
]) . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tasks'), 'url' => ['tasks-cart/'.$actionName, 'views_id' => $model->gridview_id]];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Gridview'), 'url' => ['gridviews/view', 'id' => $model->gridview_id, 'tab' => 2]];
$this->params['breadcrumbs'][] = ['label' => $model->entityType->title.'['.$model->field->title.']', 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="gridview-fields-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
