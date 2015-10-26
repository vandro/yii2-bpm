<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\bootstrap\Tabs;

/* @var $this yii\web\View */
/* @var $model common\modules\entity\common\models\User */

$this->title = $model->username;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

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

    <?= Tabs::widget([
        'items' => [
            [
                'label' => 'User',
                'content' => DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        'id',
                        [
                            'attribute' => 'organisation_id',
                            'value' => !empty($model->organisation_id)?$model->organisation->title:'No',
                        ],
                        [
                            'attribute' => 'department_id',
                            'value' => !empty($model->department_id)?$model->department->title:'No',
                        ],
                        'first_name',
                        'last_name',
                        'username',
                        'email:email',
                        'password_hash',
                        'status',
                        'role',
                        'auth_key',
                        'password_reset_token',
                        'account_activation_token',
                        'created_at',
                        'updated_at',
                    ],
                ]),
                'active' => ($tab == 1),
            ],
            [
                'label' =>'Roles',
                'content' => $this->render('_rolesIndex', [
                    'model' => $model,
                ]),
                'active' => ($tab == 2),
            ],
            [
                'label' =>'Organizations/Departments',
                'content' => $this->render('_uodIndex', [
                    'model' => $model,
                ]),
                'active' => ($tab == 3),
            ],
        ],
    ]);?>


</div>
