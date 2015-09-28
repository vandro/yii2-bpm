<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\modules\entity\common\models\permission\Gridviews */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Gridviews',
]) . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tasks'), 'url' => ['tasks-cart/'.$actionName, 'views_id' => $model->id]];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id, 'action' => $actionName]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="gridviews-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
