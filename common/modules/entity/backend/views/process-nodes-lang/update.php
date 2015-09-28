<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\modules\entity\common\models\ProcessesLang */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Processes Lang',
]) . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Processes', 'url' => ['/entity/processes/index']];
$this->params['breadcrumbs'][] = ['label' => $model->main0->process->title, 'url' => ['/entity/processes/view?id='.$model->main0->process_id.'&tab=3']];
$this->params['breadcrumbs'][] = ['label' => $model->main0->title, 'url' => ['/entity/process-nodes/view?id='.$model->main.'&tab=2']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="processes-lang-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
