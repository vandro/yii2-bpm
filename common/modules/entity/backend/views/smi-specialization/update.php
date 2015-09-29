<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\modules\entity\common\models\smi\SmiSpecialization */

$this->title = 'Update Smi Specialization: ' . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Smi Specializations', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="smi-specialization-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
