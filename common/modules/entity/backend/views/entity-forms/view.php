<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\bootstrap\Tabs;

/* @var $this yii\web\View */
/* @var $model common\modules\entity\common\models\EntityForms */

$this->title = $model->title;

$this->params['breadcrumbs'][] = ['label' => 'Entity Types', 'url' => ['/entity/entity-types/index']];
$this->params['breadcrumbs'][] = ['label' => $model->entity->title, 'url' => ['/entity/entity-types/view?id='.$model->entity_id.'&tab=3']];
//$this->params['breadcrumbs'][] = ['label' => 'Entity Forms', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="entity-forms-view">

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
                'label' => 'Form',
                'content' => DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        'id',
                        'entity_id',
                        'title',
                        'code',
                        'html:ntext',
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
                'label' =>'Rules',
                'content' => $this->render('_rulesIndex', [
                    'model' => $model,
                ]),
                'active' => ($tab == 3),
            ],
            [
                'label' =>'Actions',
                'content' => $this->render('_actionsIndex', [
                    'model' => $model,
                ]),
                'active' => ($tab == 4),
            ],
            [
                'label' =>'Child forms',
                'content' => $this->render('_childFormsIndex', [
                    'model' => $model,
                ]),
                'active' => ($tab == 5),
            ],
        ],
    ]);?>

</div>
