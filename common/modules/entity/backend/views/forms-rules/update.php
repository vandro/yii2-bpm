<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\modules\entity\common\models\FormsRules */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Forms Rules',
]) . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Entity Types', 'url' => ['/entity/entity-types/index']];
$this->params['breadcrumbs'][] = ['label' => $model->form->entity->title, 'url' => ['/entity/entity-types/view?id='.$model->form->entity_id.'&tab=3']];
$this->params['breadcrumbs'][] = ['label' => $model->form->title, 'url' => ['/entity/entity-forms/view?id='.$model->form_id.'&tab=3']];
$this->params['breadcrumbs'][] = ['label' => 'Rule #'.$model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="forms-rules-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
