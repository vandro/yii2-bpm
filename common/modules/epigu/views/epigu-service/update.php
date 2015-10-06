<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\modules\epigu\models\EpiguService */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Epigu Service',
]) . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Epigu Services'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="epigu-service-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
