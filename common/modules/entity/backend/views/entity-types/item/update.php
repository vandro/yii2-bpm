<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Entity */

$this->title = 'Update Item: ' . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Entities', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="entity-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'itemModel' => $itemModel,
    ]) ?>

</div>
