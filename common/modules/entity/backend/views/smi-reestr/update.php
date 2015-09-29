<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\modules\entity\common\models\smi\SmiReestr */

$this->title = 'Update Smi Reestr: ' . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Smi Reestrs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="smi-reestr-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
