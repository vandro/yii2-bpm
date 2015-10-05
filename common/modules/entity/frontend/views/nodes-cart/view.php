<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\bootstrap\Tabs;
use common\modules\entity\common\config\Config;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model common\modules\entity\common\models\ProcessNodes */

$this->title = $model->title;
//$this->params['breadcrumbs'][] = ['label' => 'Processes', 'url' => ['/entity/processes/index']];
//$this->params['breadcrumbs'][] = ['label' => $model->process->title, 'url' => ['/entity/processes/view?id='.$model->process_id.'&tab=3']];
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="process-nodes-view">

    <nav id="navbar-example" class="navbar navbar-default navbar-static box1">
        <div class="container-fluid">
            <div class="navbar-header">
                <button class="navbar-toggle collapsed" type="button" data-toggle="collapse" data-target=".bs-example-js-navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#"><?= Html::encode($task->process->title) ?></a>
            </div>
            <div class="collapse navbar-collapse bs-example-js-navbar-collapse">
                <?php $urls = $model->getActionsUrls($task);
                if(!empty($urls)){ ?>
                    <ul class="nav navbar-nav navbar-right">
                        <li id="fat-menu" class="dropdown">
                            <a id="drop3" href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                Действия
                                <span class="caret"></span>
                            </a>
                            <?= \yii\bootstrap\Dropdown::widget([
                                'items' => $urls,
                            ]);
                            ?>
                        </li>
                    </ul>
                <?php }?>
            </div><!-- /.nav-collapse -->
        </div><!-- /.container-fluid -->
    </nav>

    <div class="panel panel-default box2">

        <div class="panel-body">
<!--            Этап: --><?//= Html::encode($this->title) ?>
        </div>
        <?=DetailView::widget([
            'model' => $model,
            'attributes' => [
                //'id',
                [
                    'attribute' => 'id',
                    'value' => $task->id,
                ],
                'title',

                //'code',
            ],
        ])?>
    </div>

<style>
    .box1 {
        margin-bottom: 0;
        border-radius: 5px 5px 0 0;
    }
    .box2 {
        border-radius: 0 0 5px 5px;
    }

    table.detail-view th {
        width: 25%;
    }

    table.detail-view td {
        width: 75%;
    }

</style>

    <?php $task->renderViews($model); ?>
    <?= $task->renderFiles(); ?>
    <?=\common\modules\log\widgets\LogWidget::widget([
        'task_id' => $task->id,
    ])?>


<!--    --><?//= GridView::widget([
//        'dataProvider' => $task->getFilesAdp(),
//        'showHeader' => false,
//        'summary' => 'Файлы',
//        'columns' => [
//            //['class' => 'yii\grid\SerialColumn'],
//
////            'id',
////            'task_id',
////            'node_id',
////            'action_id',
//            //'name',
//            [
//                'format' => 'html',
//                'value' => function($model){
//                    //$customUrl = Yii::$app->getUrlManager()->createUrl([]);
//                    return Html::a( $model->name, $model->urlPath,
//                        ['title' => Yii::t('yii', $model->name)]);
//                }
//            ],
//            // 'ext',
//            // 'directoryPath:ntext',
//            // 'urlPath:ntext',
//
//            //['class' => 'yii\grid\ActionColumn'],
//        ],
//    ]); ?>

</div>
