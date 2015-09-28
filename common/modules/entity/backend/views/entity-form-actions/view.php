<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\bootstrap\Tabs;
use common\modules\entity\common\models\ProcessNodes;
use common\modules\entity\common\models\EntityForms;

/* @var $this yii\web\View */
/* @var $model common\modules\entity\common\models\NodesActions */

$this->title = 'Action: '.$model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Nodes Actions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="nodes-actions-view">

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
                'label' => 'Action',
                'content' => DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        'id',
                        [
                            'attribute' => 'form_id',
                            'value' => EntityForms::findOne($model['form_id'])->title,
                        ],
                        [
                            'attribute' => 'next_node_id',
                            'value' => ProcessNodes::findOne($model['next_node_id'])->title,
                        ],
                        'title',
                        'code',
                        'type',
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
        ],
    ]);?>

</div>
