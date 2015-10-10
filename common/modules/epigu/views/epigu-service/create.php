<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\modules\epigu\models\EpiguService */

$this->title = Yii::t('app', 'Create Epigu Service');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Epigu Services'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="epigu-service-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
