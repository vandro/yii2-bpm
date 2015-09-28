<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\modules\entity\common\models\permission\ProcessOrganDepartLink */

$this->title = Yii::t('app', 'Create Process Organ Depart Link');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Process Organ Depart Links'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="process-organ-depart-link-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
