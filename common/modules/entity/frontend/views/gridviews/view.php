<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\bootstrap\Tabs;

/* @var $this yii\web\View */
/* @var $model common\modules\entity\common\models\permission\Gridviews */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tasks'), 'url' => ['tasks-cart/'.$actionName, 'views_id' => $model->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gridviews-view">

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
                'label' =>'Columns',
                'content' => $this->render('_fieldsIndex', [
                    'model' => $model,
                ]),
                'active' => ($tab == 2),
            ],
            [
                'label' => 'View',
                'content' => DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        'id',
                        'title',
                        'default',
                    ],
                ]),
                'active' => ($tab == 1),
            ],
//            [
//                'label' =>'Forms',
//                'content' => $this->render('_formsIndex', [
//                    'model' => $model,
//                ]),
//                'active' => ($tab == 3),
//            ],
//            [
//                'label' =>'Views',
//                'content' => $this->render('_viewsIndex', [
//                    'model' => $model,
//                ]),
//                'active' => ($tab == 5),
//            ],
//            [
//                'label' =>'Translate',
//                'content' => $this->render('_langIndex', [
//                    'model' => $model,
//                ]),
//                'active' => ($tab == 2),
//            ],
        ],
    ]);?>

<!--    --><?//=\common\helpers\DebugHelper::printSingleObject($gridViewParams)?>
<!--    --><?//=\frontend\runtime\generated\GridView4::render()?>
    <?=$gridView::render();?>
<!--    --><?//=\common\helpers\DebugHelper::printSingleObject($gridView)?>
</div>
