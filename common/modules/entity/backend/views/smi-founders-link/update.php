<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\modules\entity\common\models\smi\SmiFoundersLink */

$this->title = 'Update Smi Founders Link: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Smi Founders Links', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="smi-founders-link-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
