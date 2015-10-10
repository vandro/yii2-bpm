<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\modules\entity\common\models\smi\SmiReestr */

$this->title = 'Create Smi Reestr';
$this->params['breadcrumbs'][] = ['label' => 'Smi Reestrs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="smi-reestr-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
