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
        <?= Html::a('Add nodes actions', ['nar-link/create', 'parent_id' => $model->id], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $model->getActionRoleLinksAdp(),
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            [
                'attribute' => 'action_id',
                'value' => function($model){
                    return !empty($model->action)?$model->action->title:'';
                }
            ],
            [
                'attribute' => 'role_id',
                'value' => function($model){
                    return !empty($model->role)?$model->role->title:'';
                }
            ],
            [
                'attribute' => 'next_node_id',
                'value' => function($model){
                    return !empty($model->nextNode)?$model->nextNode->title:'Нет';
                }
            ],
            'execution_type',
            [
                'attribute' => 'has_file_upload',
                'value' => function($model){
                    return !empty($model->has_file_upload)?'Да':'Нет';
                }
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template'=>'{view} {update} {delete}',
                'buttons'=>[
                    'view'=>function ($url, $model) {
                        return ActionColumnHelper::view($url,$model,'entity/nar-link');
                    },
                    'update'=>function ($url, $model) {
                        return ActionColumnHelper::update($url,$model,'entity/nar-link');
                    },
                    'delete'=>function ($url, $model) {
                        return ActionColumnHelper::delete($url,$model,'entity/nar-link');
                    },
                ],

            ],
        ],
    ]); ?>

</div>
