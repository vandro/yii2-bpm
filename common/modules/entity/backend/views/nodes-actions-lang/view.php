<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\modules\entity\common\models\ProcessesLang */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Nodes actions', 'url' => ['/entity/nodes-actions/index']];
$this->params['breadcrumbs'][] = ['label' => $model->main0->title, 'url' => ['/entity/nodes-actions/view?id='.$model->main.'&tab=2']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="processes-lang-view">

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
            'main',
            'lang',
            'title',
        ],
    ]) ?>

</div>
