<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\modules\epigu\models\EpiguServiceFileds */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Epigu Service Fileds'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="epigu-service-fileds-view">

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
            'epigu_service_id',
            'epigu_fileld_id',
            'name',
            'group:ntext',
            'label_ru',
            'label_uz',
            'label_en',
            'description_ru',
            'description_uz',
            'description_en',
            'has_group',
            'type',
            'depend',
            'has_dependents',
            'is_default',
            'disabled',
            'defaultValue',
            'api',
            'validators',
            'step',
            'mode',
            'inResult',
        ],
    ]) ?>

</div>
