<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\modules\entity\common\models\permission\GridviewFields */
$actionName = Yii::$app->cache->get('action'.Yii::$app->user->id);
$actionName = !empty($actionName)?$actionName:'active';

$this->title = $model->entityType->title.'['.$model->field->title.']';
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tasks'), 'url' => ['tasks-cart/'.$actionName, 'views_id' => $model->gridview_id]];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Gridview'), 'url' => ['gridviews/view', 'id' => $model->gridview_id, 'tab' => 2]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gridview-fields-view">

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

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'attribute' => 'gridview_id',
                'value' => !empty($model->gridview)?$model->gridview->title:'No',
            ],
            [
                'attribute' => 'entity_type_id',
                'value' => !empty($model->entityType)?$model->entityType->title:'No',
            ],
            [
                'attribute' => 'field_id',
                'value' => !empty($model->field)?$model->field->title:'No',
            ],
            'order',
        ],
    ]) ?>

</div>
