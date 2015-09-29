<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Rules */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Rules', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rules-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['item-update', 'id' => $itemModel->id, 'item_id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Return to Entity', ['view', 'id' => $model->id, 'tab' => 3], ['class' => 'btn btn-default']) ?>
        <?= Html::a('Delete', ['item-delete', 'id' => $itemModel->id, 'item_id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $itemModel,
        'attributes' => $model->getItemFieldsForDetailView($itemModel),
    ]) ?>

</div>
