<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\modules\entity\common\models\UserRoleLinks */

$this->title = $model->role->title;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['/entity/user/index']];
$this->params['breadcrumbs'][] = ['label' => $model->user->username, 'url' => ['/entity/user/view?id='.$model->user_id.'&tab=2']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-role-links-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'user_id',
            'role_id',
        ],
    ]) ?>

</div>
