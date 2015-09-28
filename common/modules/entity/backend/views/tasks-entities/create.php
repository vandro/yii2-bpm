<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\modules\entity\common\models\TasksEntitiesLink */

$this->title = Yii::t('app', 'Create Tasks Entities Link');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tasks Entities Links'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tasks-entities-link-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
