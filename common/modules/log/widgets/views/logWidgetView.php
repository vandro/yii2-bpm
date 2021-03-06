<?php
/**
 * Created by PhpStorm.
 * User: a_niyazov
 * Date: 04.10.2015
 * Time: 11:42
 */
use yii\grid\GridView;
?>

<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Лог</h3>
    </div>
    <?= GridView::widget([
        'dataProvider' => $logsAdp,
        'showHeader' => false,
        'summary' => '',
        'tableOptions' => [
            'style' => 'margin-bottom: 0;',
            'class' => 'table table-striped',
        ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'log_at',

            [
                'attribute' => 'node_id',
                'format' => 'html',
                'value' => function($model){
                    $html = 'Шаг "'.$model->node->title.'"';
                    return $html;
                }
            ],
            [
                'attribute' => 'action_id',
                'format' => 'html',
                'value' => function($model){
                    $html = 'Действие "'.$model->action->title.'"';
                    return $html;
                }
            ],
            [
                'attribute' => 'user_id',
                'format' => 'html',
                'value' => function($model){
                   $html = 'Участник "'.$model->user->username.'"';
                    return $html;
                }
            ],

        ],
    ]);?>
</div>



