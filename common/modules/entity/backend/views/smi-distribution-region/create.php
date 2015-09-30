<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\modules\entity\common\models\smi\SmiDistributionRegion */

$this->title = 'Create Smi Distribution Region';
$this->params['breadcrumbs'][] = ['label' => 'Smi Distribution Regions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="smi-distribution-region-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
