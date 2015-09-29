<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\modules\entity\common\models\smi\SmiFoundersLink */

$this->title = 'Create Smi Founders Link';
$this->params['breadcrumbs'][] = ['label' => 'Smi Founders Links', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="smi-founders-link-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
