<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\bootstrap\Tabs;

/* @var $this yii\web\View */
/* @var $model common\modules\entity\common\models\EntityFields */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Entity Types', 'url' => ['/entity/entity-types/index']];
$this->params['breadcrumbs'][] = ['label' => $model->entity->title, 'url' => ['/entity/entity-types/view?id='.$model->entity_id.'&tab=4']];
//$this->params['breadcrumbs'][] = ['label' => 'Entity Fields', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="entity-fields-view">

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
                'label' => 'Field',
                'content' => DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        'id',
                        'entity_id',
                        'title',
                        'code',
                        'type',
                        'length',
                        'dictionary_id',
                        //'options:ntext',
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
