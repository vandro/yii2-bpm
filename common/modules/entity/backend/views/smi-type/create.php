<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\modules\entity\common\models\smi\SmiType */

$this->title = 'Create Smi Type';
$this->params['breadcrumbs'][] = ['label' => 'Smi Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="smi-type-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
