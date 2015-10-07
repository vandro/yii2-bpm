<?php
/**
 * Created by PhpStorm.
 * User: a_niyazov
 * Date: 01.09.2015
 * Time: 15:14
 */

use yii\helpers\Html;
use yii\grid\GridView;
use common\helpers\ActionColumnHelper;

/* @var $this yii\web\View */
/* @var $searchModel common\modules\entity\common\models\EntityFormsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

?>
<div class="entity-forms-index">
    <br>

    <p>
        <?= Html::a('Add handler', ['action-handler/create', 'parent_id' => $model->action_id], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $model->getHandlersAdp(),
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'handler_id',
                'value' => function($model){
                    return !empty($model->handler)?$model->handler->title:'';
                }
            ],
            'type',
            [
                'class' => 'yii\grid\ActionColumn',
                'template'=>'{add} {view} {update} {delete} ',
                'controller' => 'action-handler'

            ],
        ],
    ]); ?>

</div>