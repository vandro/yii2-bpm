<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\modules\entity\common\models\FormsRules */

$this->title = 'Rule #'.$model->id;
$this->params['breadcrumbs'][] = ['label' => 'Entity Types', 'url' => ['/entity/entity-types/index']];
$this->params['breadcrumbs'][] = ['label' => $model->form->entity->title, 'url' => ['/entity/entity-types/view?id='.$model->form->entity_id.'&tab=3']];
$this->params['breadcrumbs'][] = ['label' => $model->form->title, 'url' => ['/entity/entity-forms/view?id='.$model->form_id.'&tab=3']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="forms-rules-view">

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
            'form_id',
            'field_id',
            'code',
            'value:ntext',
        ],
    ]) ?>

</div>
