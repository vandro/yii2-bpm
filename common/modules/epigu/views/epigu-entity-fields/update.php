<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\modules\epigu\models\EpiguAndEntityFieldsLink */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Epigu And Entity Fields Link',
]) . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Epigu And Entity Fields Links'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="epigu-and-entity-fields-link-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
