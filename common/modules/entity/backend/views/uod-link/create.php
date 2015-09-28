<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\modules\entity\common\models\permission\UserOrganDepartLink */

$this->title = Yii::t('app', 'Create User Organ Depart Link');
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['/entity/user/index']];
//$this->params['breadcrumbs'][] = ['label' => $model->user->username, 'url' => ['/entity/user/view?id='.$model->user_id.'&tab=3']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-organ-depart-link-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
