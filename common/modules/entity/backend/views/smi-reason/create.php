<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\modules\entity\common\models\smi\SmiReasonToOpen */

$this->title = 'Create Smi Reason To Open';
$this->params['breadcrumbs'][] = ['label' => 'Smi Reason To Opens', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="smi-reason-to-open-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
