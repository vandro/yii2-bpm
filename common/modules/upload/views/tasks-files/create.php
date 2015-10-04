<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\modules\upload\models\TasksFiles */

$this->title = 'Create Tasks Files';
$this->params['breadcrumbs'][] = ['label' => 'Tasks Files', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tasks-files-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
