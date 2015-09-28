<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\modules\entity\common\models\Departments */

$this->title = Yii::t('app', 'Add Department');
$this->params['breadcrumbs'][] = ['label' => 'Organizations', 'url' => ['/entity/organizations/index']];
$this->params['breadcrumbs'][] = ['label' => $model->organisation->title, 'url' => ['/entity/organizations/view?id='.$model->organisation_id.'&tab=2']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="departments-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
