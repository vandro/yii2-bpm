<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\modules\entity\common\models\smi\SmiFounders */

$this->title = 'Create Smi Founders';
$this->params['breadcrumbs'][] = ['label' => 'Smi Founders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="smi-founders-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
