<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\modules\entity\common\models\Departments */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Departments',
]) . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Organizations', 'url' => ['/entity/organizations/index']];
$this->params['breadcrumbs'][] = ['label' => $model->organisation->title, 'url' => ['/entity/organizations/view?id='.$model->organisation_id.'&tab=2']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="departments-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
