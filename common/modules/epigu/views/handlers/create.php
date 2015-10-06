<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\modules\epigu\models\Handlers */

$this->title = Yii::t('app', 'Create Handlers');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Handlers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="handlers-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
