<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\bootstrap\Tabs;

/* @var $this yii\web\View */
/* @var $model common\modules\entity\common\models\Processes */

$this->title = 'Process: '.$model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Processes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="processes-view">

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
                'label' => 'Entity',
                'content' => DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        'id',
                        'title',
                        'code',
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
                'label' =>'Nodes',
                'content' => $this->render('_nodesIndex', [
                    'model' => $model,
                ]),
                'active' => ($tab == 3),
            ],
//            [
//                'label' =>'Fields',
//                'content' => $this->render('_fieldsIndex', [
//                    'model' => $model,
//                ]),
//                'active' => ($tab == 4),
//            ],
//            [
//                'label' =>'Views',
//                'content' => $this->render('_viewsIndex', [
//                    'model' => $model,
//                ]),
//                'active' => ($tab == 5),
//            ],
        ],
    ]);?>

</div>
