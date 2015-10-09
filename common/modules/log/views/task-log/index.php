<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\modules\log\models\TaskLogSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Лог задач');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="task-log-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

<!--    <p>-->
<!--        --><?//= Html::a(Yii::t('app', 'Create Task Log'), ['create'], ['class' => 'btn btn-success']) ?>
<!--    </p>-->

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'log_at',
//            'process_id',
//            'task_id',
//            'node_id',
            // 'action_id',
            // 'user_id',
            [
                'attribute' => 'process_id',
                'format' => 'html',
                'value' => function($model){
                    return $model->process->title;
                }
            ],
            [
                'attribute' => 'task_id',
                'format' => 'html',
                'value' => function($model){
                   return $model->task->id;
                }
            ],
            [
                'attribute' => 'node_id',
                'format' => 'html',
                'value' => function($model){
                    return $model->node->title;
                }
            ],
            [
                'attribute' => 'action_id',
                'format' => 'html',
                'value' => function($model){
                    return  $model->action->title;
                }
            ],
            [
                'attribute' => 'user_id',
                'format' => 'html',
                'value' => function($model){
                    return $model->user->username;
                }
            ],

//            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
