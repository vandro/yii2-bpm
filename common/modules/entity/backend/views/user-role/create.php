<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\modules\entity\common\models\UserRoleLinks */

$this->title = Yii::t('app', 'Create User Role Links');
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['/entity/user/index']];
//$this->params['breadcrumbs'][] = ['label' => $model->user->username, 'url' => ['/entity/user/view?id='.$model->user_id.'&tab=2']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-role-links-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
