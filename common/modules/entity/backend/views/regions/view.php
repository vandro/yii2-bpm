<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\bootstrap\Tabs;

/* @var $this yii\web\View */
/* @var $model common\modules\entity\common\models\Regions */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Regions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="regions-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
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
                        'order',
                    ],
                ]),
                'active' => ($tab == 1),
            ],
            [
                'label' =>'Cities',
                'content' => $this->render('_citiesIndex', [
                    'model' => $model,
                ]),
                'active' => ($tab == 2),
            ],
        ],
    ]);?>

</div>
