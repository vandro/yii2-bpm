<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\modules\entity\common\models\smi\SmiKind */

$this->title = 'Update Smi Kind: ' . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Smi Kinds', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="smi-kind-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
