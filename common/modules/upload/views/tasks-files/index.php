<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\modules\upload\models\TasksFilesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tasks Files';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tasks-files-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Tasks Files', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'task_id',
            'node_id',
            'action_id',
            'name',
            // 'ext',
            // 'directoryPath:ntext',
            // 'urlPath:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
