<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\modules\epigu\models\InActionEntityLink */

$this->title = Yii::t('app', 'Create In Action Entity Link');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'In Action Entity Links'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="in-action-entity-link-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
