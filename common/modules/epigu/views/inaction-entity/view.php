<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\modules\epigu\models\InActionEntityLink */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'In Action Entity Links'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="in-action-entity-link-view">

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
            'integration_action_id',
            'entity_type_id',
        ],
    ]) ?>

</div>
