<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\bootstrap\Tabs;

/* @var $this yii\web\View */
/* @var $model common\modules\epigu\models\IntegrationActions */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Integration Actions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="integration-actions-view">

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
                'label' => 'Integration Action',
                'content' => DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        'id',
                        'title',
                        'code',
                        [
                            'attribute' => 'process_id',
                            'value' => !empty($model->process)?$model->process->title:'',
                        ],
                    ],
                ]),
                'active' => ($tab == 1),
            ],
            [
                'label' =>'Entity Type',
                'content' => $this->render('_entityTypesIndex', [
                    'model' => $model,
                ]),
                'active' => ($tab == 2),
            ],
            [
                'label' =>'Condition tasks',
                'content' => $this->render('_conditionTasksIndex', [
                    'model' => $model,
                ]),
                'active' => ($tab == 3),
            ],
        ],
    ]);?>

</div>
