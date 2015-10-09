<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\modules\entity\common\models\smi\SmiKind */

$this->title = 'Create Smi Kind';
$this->params['breadcrumbs'][] = ['label' => 'Smi Kinds', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="smi-kind-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
