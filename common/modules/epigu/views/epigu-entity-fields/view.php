<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\modules\epigu\models\EpiguAndEntityFieldsLink */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Epigu And Entity Fields Links'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="epigu-and-entity-fields-link-view">

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
            'in_action_entity_link_id',
            'epigu_service_id',
            'epigu_service_field_id',
            'entity_type_id',
            'entity_type_fields_id',
        ],
    ]) ?>

</div>
