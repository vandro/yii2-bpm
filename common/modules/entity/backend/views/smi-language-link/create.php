<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\modules\entity\common\models\smi\SmiLanguageLink */

$this->title = 'Create Smi Language Link';
$this->params['breadcrumbs'][] = ['label' => 'Smi Language Links', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="smi-language-link-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
