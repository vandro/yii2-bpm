<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\modules\entity\common\models\smi\SmiSpecializationLink */

$this->title = 'Create Smi Specialization Link';
$this->params['breadcrumbs'][] = ['label' => 'Smi Specialization Links', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="smi-specialization-link-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
