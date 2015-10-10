<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\modules\epigu\models\IntegrationActions */

$this->title = Yii::t('app', 'Create Integration Actions');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Integration Actions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="integration-actions-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
