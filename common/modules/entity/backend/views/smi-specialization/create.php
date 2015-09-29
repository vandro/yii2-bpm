<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\modules\entity\common\models\smi\SmiSpecialization */

$this->title = 'Create Smi Specialization';
$this->params['breadcrumbs'][] = ['label' => 'Smi Specializations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="smi-specialization-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
