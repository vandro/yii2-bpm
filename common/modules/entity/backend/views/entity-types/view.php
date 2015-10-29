<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\bootstrap\Tabs;
/* @var $this yii\web\View */
/* @var $model common\modules\entity\common\models\EntityTypes */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Entity Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="entity-types-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php if($model->added < 1) {
            echo Html::a('Build', ['build', 'id' => $model->id], ['class' => 'btn btn-success']);
        }?>
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
                        'code',
                        [
                            'attribute' => 'database_id',
                            'value' => !empty($model->database)? $model->database->title.' ('.$model->database->code.')':'Нет',
                        ],
                        [
                            'attribute' => 'type_id',
                            'value' => !empty($model->type)? $model->type->title:'Нет',
                        ],
                        [
                            'attribute' => 'added',
                            'value' => $model->added == 1?'Да':'Нет',
                        ],
                        [
                            'attribute' => 'published',
                            'value' => $model->published == 1?'Да':'Нет',
                        ],
                    ],
                ]),
                'active' => ($tab == 1),
            ],
            [
                'label' =>'Fields',
                'content' => $this->render('_fieldsIndex', [
                    'model' => $model,
                ]),
                'active' => ($tab == 4),
            ],
            [
                'label' =>'Forms',
                'content' => $this->render('_formsIndex', [
                    'model' => $model,
                ]),
                'active' => ($tab == 3),
            ],
            [
                'label' =>'Views',
                'content' => $this->render('_viewsIndex', [
                    'model' => $model,
                ]),
                'active' => ($tab == 5),
            ],
            [
                'label' =>'Translate',
                'content' => $this->render('_langIndex', [
                    'model' => $model,
                ]),
                'active' => ($tab == 2),
            ],
//            [
//                'label' =>'Items',
//                'content' => $this->render('_itemsIndex', [
//                    'model' => $model,
//                ]),
//                'active' => ($tab == 6),
//            ],
        ],
    ]);?>

</div>
