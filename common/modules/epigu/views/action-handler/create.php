<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\modules\epigu\models\ActionHandlerLink */

$this->title = Yii::t('app', 'Create Action Handler Link');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Action Handler Links'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="action-handler-link-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
