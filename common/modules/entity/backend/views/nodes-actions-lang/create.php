<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\modules\entity\common\models\ProcessesLang */

$this->title = Yii::t('app', 'Create nodes actions Lang');
$this->params['breadcrumbs'][] = ['label' => 'Nodes actions', 'url' => ['/entity/nodes-actions/index']];
$this->params['breadcrumbs'][] = ['label' => $model->main0->title, 'url' => ['/entity/nodes-actions/view?id='.$model->main.'&tab=2']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="processes-lang-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
