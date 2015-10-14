<?php
/**
 * Created by PhpStorm.
 * User: a_niyazov
 * Date: 01.09.2015
 * Time: 14:32
 */

use yii\helpers\Html;
use yii\grid\GridView;
use common\helpers\ActionColumnHelper;

/* @var $this yii\web\View */
/* @var $searchModel common\modules\entity\common\models\EntityTypesLangSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */


?>
<div class="entity-types-lang-index">
<br>
    <p>
        <?= Html::a('Create process Node', ['process-nodes/create', 'parent_id' => $model->id], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $model->getNodesAdp(),
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'title',
            'code',
            'order_status',
            'execution_type',


            [
                'class' => 'yii\grid\ActionColumn',
                'template'=>'{view} {update} {delete}',
                'buttons'=>[
                    'view'=>function ($url, $model) {
                        return ActionColumnHelper::view($url,$model,'entity/process-nodes');
                    },
                    'update'=>function ($url, $model) {
                        return ActionColumnHelper::update($url,$model,'entity/process-nodes');
                    },
                    'delete'=>function ($url, $model) {
                        return ActionColumnHelper::delete($url,$model,'entity/process-nodes');
                    },
                ],

            ],
        ],
    ]); ?>

</div>
