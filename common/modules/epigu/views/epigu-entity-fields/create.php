<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\modules\epigu\models\EpiguAndEntityFieldsLink */

$this->title = Yii::t('app', 'Create Epigu And Entity Fields Link');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Epigu And Entity Fields Links'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="epigu-and-entity-fields-link-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
