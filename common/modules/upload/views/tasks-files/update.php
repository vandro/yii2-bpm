<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\modules\upload\models\TasksFiles */

$this->title = 'Update Tasks Files: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Tasks Files', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tasks-files-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
