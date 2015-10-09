<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\modules\entity\common\models\smi\SmiReestResonLink */

$this->title = 'Create Smi Reest Reson Link';
$this->params['breadcrumbs'][] = ['label' => 'Smi Reest Reson Links', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="smi-reest-reson-link-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
