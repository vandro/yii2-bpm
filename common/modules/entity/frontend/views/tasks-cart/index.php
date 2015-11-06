<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\helpers\ActionColumnHelper;
use common\modules\entity\common\config\Config;

/* @var $this yii\web\View */
/* @var $searchModel common\modules\entity\common\models\TasksCartSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Tasks');
$this->params['breadcrumbs'][] = $this->title;
$this->params['breadcrumbs'][] = str_replace("action","",Yii::$app->controller->action->actionMethod);
?>
<div class="tasks-cart-index">

<!--    <h1>--><?//= Html::encode($this->title) ?><!--</h1>-->
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

<!--    <p style="align: right">-->
<!--        --><?//= Html::a(Yii::t('app', 'Views'), ['create'], ['class' => 'btn btn-primary']) ?>
<!--    </p>-->

    <nav id="navbar-example" class="navbar navbar-default navbar-static">
        <div class="container-fluid">
            <div class="navbar-header">
                <button class="navbar-toggle collapsed" type="button" data-toggle="collapse" data-target=".bs-example-js-navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#"><?= Html::encode($this->title) ?> / <?=!empty($view)?$view->title:''?></a>
            </div>
            <div class="collapse navbar-collapse bs-example-js-navbar-collapse">
<!--                --><?php //$urls = $model->getActionsUrls($task);
//                if(!empty($urls)): ?>
                    <ul class="nav navbar-nav navbar-right">
                        <li id="fat-menu" class="dropdown">
                            <a id="drop3" href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                Views
                                <span class="caret"></span>
                            </a>
                            <?= \yii\bootstrap\Dropdown::widget([
                                'items' => $gridViewsUrls,
                            ]);
                            ?>
                        </li>
                        <?php if(!empty($view)) : ?>
                        <li>
                            <a href="<?=Yii::$app->getUrlManager()->createUrl([Config::MODULE_NAME . '/gridviews/view', 'id' => $view->id, 'action' => $actionName]) ?>">
                                <span class="glyphicon glyphicon-eye-open"></span>
                            </a>
                        </li>
                            <li>
                                <a href="<?=Yii::$app->getUrlManager()->createUrl([Config::MODULE_NAME . '/gridviews/update', 'id' => $view->id, 'action' => $actionName]) ?>">
                                    <span class="glyphicon glyphicon-pencil"></span>
                                </a>
                            </li>
                        <li>
                            <a href="<?=Yii::$app->getUrlManager()->createUrl([Config::MODULE_NAME . '/gridviews/delete', 'id' => $view->id, 'action' => $actionName]) ?>">
                                <span class="glyphicon glyphicon-trash"></span>
                            </a>
                        </li>
                        <?php endif ?>
                    </ul>
<!--                --><?php //endif?>
            </div><!-- /.nav-collapse -->
        </div><!-- /.container-fluid -->
    </nav>

    <?=$gridView::render($status)?>

<!--    --><?//= GridView::widget([
//        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
//        'columns' => [
//            'id',
//            [
//                'attribute' => 'process_id',
//                'value' => function($model){
//                    return $model->process->title;
//                }
//            ],
//            [
//                'attribute' => 'current_node_id',
//                'value' => function($model){
//                    return $model->currentNode->title;
//                }
//            ],
//            'created_at',
//
//            [
//                'class' => 'yii\grid\ActionColumn',
//                'template'=>'{view}{delete}',
//                'buttons'=>[
//                    'view'=>function ($url, $model) {
//                        return ActionColumnHelper::view($url,$model,'bpm/tasks-cart');
//                    },
//                    'update'=>function ($url, $model) {
//                        return ActionColumnHelper::update($url,$model,'bpm/tasks-cart');
//                    },
//                    'delete'=>function ($url, $model) {
//                        return ActionColumnHelper::delete($url,$model,'bpm/tasks-cart');
//                    },
//                ],
//
//            ],
//        ],
//    ]); ?>

</div>
