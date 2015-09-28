<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\modules\entity\common\models\EntityForms;

/* @var $this yii\web\View */
/* @var $searchModel common\modules\entity\common\models\NodesActionsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Nodes Actions');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="nodes-actions-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Nodes Actions'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
            [
                'attribute' => 'form_id',
                'value' => function($model){
                    return $model->form->title;
                }
            ],
            [
                'attribute' => 'next_node_id',
                'value' => function($model){
                    return $model->nextNode->title;
                }
            ],
            'title',
            'code',
            // 'type',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
