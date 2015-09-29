<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\modules\entity\common\models\smi\SmiLanguageLink */

$this->title = 'Update Smi Language Link: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Smi Language Links', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="smi-language-link-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
