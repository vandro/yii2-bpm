<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\modules\entity\common\models\ProcessNodes */

$this->title = Yii::t('app', 'Create Process Nodes');
$this->params['breadcrumbs'][] = ['label' => 'Processes', 'url' => ['/entity/processes/index']];
$this->params['breadcrumbs'][] = ['label' => $model->process->title, 'url' => ['/entity/processes/view?id='.$model->process_id.'&tab=3']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="process-nodes-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
