<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\bootstrap\Tabs;

/* @var $this yii\web\View */
/* @var $model common\modules\entity\common\models\EntityViews */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Entity Types', 'url' => ['/entity/entity-types/index']];
$this->params['breadcrumbs'][] = ['label' => $model->entity->title, 'url' => ['/entity/entity-types/view?id='.$model->entity_id.'&tab=5']];
//$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Entity Views'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="entity-views-view">

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
                'label' => 'View',
                'content' => DetailView::widget([
                    'model' => $model,
                    'attributes' => [
//                        'id',
//                        'entity_id',
                        'title',
                        'code',
                        [
                            'attribute' => 'parent_view_id',
                            'value' => !empty($model->parentView)?$model->parentView->title:'',
                        ],
                        [
                            'attribute' => 'foreign_key_field_id',
                            'value' => !empty($model->foreignKeyField)?$model->foreignKeyField->title:'',
                        ],
                        'settings',
//                        'html:ntext',,
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
                'label' =>'Child Views',
                'content' => $this->render('_childViewsIndex', [
                    'model' => $model,
                ]),
                'active' => ($tab == 4),
            ],
        ],
    ]);?>

</div>
