<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\modules\entity\common\models\Databeses */

$this->title = Yii::t('app', 'Create Databeses');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Databeses'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="databeses-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
