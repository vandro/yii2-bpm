<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\modules\entity\common\models\ViewsRules */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Entity Types', 'url' => ['/entity/entity-types/index']];
$this->params['breadcrumbs'][] = ['label' => $model->view->entity->title, 'url' => ['/entity/entity-types/view?id='.$model->view->entity_id.'&tab=5']];
$this->params['breadcrumbs'][] = ['label' => $model->view->title, 'url' => ['/entity/entity-views/view?id='.$model->view_id.'&tab=3']];
$this->params['breadcrumbs'][] = 'Rule #'.$this->title;
?>
<div class="views-rules-view">

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
            'view_id',
            'field_id',
            'code',
            'value:ntext',
        ],
    ]) ?>

</div>
