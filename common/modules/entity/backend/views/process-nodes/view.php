<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\bootstrap\Tabs;

/* @var $this yii\web\View */
/* @var $model common\modules\entity\common\models\ProcessNodes */

$this->title = 'Node: '.$model->title;
$this->params['breadcrumbs'][] = ['label' => 'Processes', 'url' => ['/entity/processes/index']];
$this->params['breadcrumbs'][] = ['label' => $model->process->title, 'url' => ['/entity/processes/view?id='.$model->process_id.'&tab=3']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="process-nodes-view">

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
                'label' => 'Node',
                'content' => DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        'id',
                        'title',
                        'code',
                        'order_status',
                        'execution_type',
                    ],
                ]),
                'active' => ($tab == 1),
            ],
            [
                'label' =>'Translate',
                'content' => $this->render('_langIndex', [
                    'model' => $model,
                ]),
                'active' => ($tab == 2),
            ],
            [
                'label' =>'Actions',
                'content' => $this->render('_actionsIndex', [
                    'model' => $model,
                ]),
                'active' => ($tab == 3),
            ],
            [
                'label' =>'Views',
                'content' => $this->render('_entityViewsIndex', [
                    'model' => $model,
                ]),
                'active' => ($tab == 4),
            ],
            [
                'label' =>'Conditions',
                'content' => $this->render('_conditionsIndex', [
                    'model' => $model,
                ]),
                'active' => ($tab == 5),
            ],
        ],
    ]);?>

</div>
