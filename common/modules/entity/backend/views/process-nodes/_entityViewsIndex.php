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
        <?= Html::a('Add nodes entity views', ['nvr-link/create', 'parent_id' => $model->id], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $model->getViewRoleLinksAdp(),
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'view_id',
                'value' => function($model){
                    return $model->view->title;
                }
            ],
            [
                'attribute' => 'role_id',
                'value' => function($model){
                    return $model->role->title;
                }
            ],
//            [
//                'attribute' => 'next_node_id',
//                'value' => function($model){
//                    return !empty($model->nextNode)?$model->nextNode->title:'Нет';
//                }
//            ],
//            'execution_type',
            [
                'class' => 'yii\grid\ActionColumn',
                'template'=>'{view} {update} {delete}',
                'buttons'=>[
                    'view'=>function ($url, $model) {
                        return ActionColumnHelper::view($url,$model,'entity/nvr-link');
                    },
                    'update'=>function ($url, $model) {
                        return ActionColumnHelper::update($url,$model,'entity/nvr-link');
                    },
                    'delete'=>function ($url, $model) {
                        return ActionColumnHelper::delete($url,$model,'entity/nvr-link');
                    },
                ],

            ],
        ],
    ]); ?>

</div>
