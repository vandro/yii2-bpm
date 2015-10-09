<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\bootstrap\Tabs;

/* @var $this yii\web\View */
/* @var $model common\modules\epigu\models\InActionEntityLink */

$this->title = $model->entityType->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Integration Actions'), 'url' => ['integration-actions/index']];
$this->params['breadcrumbs'][] = ['label' => $model->integrationAction->title, 'url' => ['integration-actions/view', 'id' => $model->integration_action_id, 'tab' => 2]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="in-action-entity-link-view">

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
                        [
                            'attribute' => 'integration_action_id',
                            'value' => !empty($model->integrationAction)?$model->integrationAction->title:'',
                        ],
                        [
                            'attribute' => 'entity_type_id',
                            'value' => !empty($model->entityType)?$model->entityType->title:'',
                        ],
                    ],
                ]),
                'active' => ($tab == 1),
            ],
            [
                'label' =>'Entity Type',
                'content' => $this->render('_epiguEntityFieldsIndex', [
                    'model' => $model,
                ]),
                'active' => ($tab == 2),
            ],
        ],
    ]);?>

</div>
