<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\modules\entity\common\models\permission\UserOrganDepartLink */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'User Organ Depart Link',
]) . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['/entity/user/index']];
$this->params['breadcrumbs'][] = ['label' => $model->user->username, 'url' => ['/entity/user/view?id='.$model->user_id.'&tab=3']];
$this->params['breadcrumbs'][] = ['label' =>$model->organisation->title.' / '.$model->department->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="user-organ-depart-link-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
