<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\modules\epigu\models\EpiguServiceFileds */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Epigu Service Fileds',
]) . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Epigu Service Fileds'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="epigu-service-fileds-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
