<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\modules\log\models\TaskLog */

$this->title = Yii::t('app', 'Create Task Log');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Task Logs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="task-log-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
