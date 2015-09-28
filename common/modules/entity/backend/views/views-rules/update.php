<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\modules\entity\common\models\ViewsRules */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Views Rules',
]) . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Entity Types', 'url' => ['/entity/entity-types/index']];
$this->params['breadcrumbs'][] = ['label' => $model->view->entity->title, 'url' => ['/entity/entity-types/view?id='.$model->view->entity_id.'&tab=5']];
$this->params['breadcrumbs'][] = ['label' => $model->view->title, 'url' => ['/entity/entity-views/view?id='.$model->view_id.'&tab=3']];
$this->params['breadcrumbs'][] = ['label' => 'Rule #'.$model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="views-rules-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
