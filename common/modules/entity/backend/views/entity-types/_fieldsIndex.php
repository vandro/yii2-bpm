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
        <?= Html::a('Create Entity Fields', ['entity-fields/create', 'parent_id' => $model->id], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $model->getFieldsAdp(),
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
//            'entity_id',
            'title',
            'code',
            'type',
            'length',
//            'html:ntext',

            [
                'class' => 'yii\grid\ActionColumn',
                'template'=>'{add} {view} {update} {delete} ',
                'buttons'=>[
                    'view'=>function ($url, $model) {
                        return ActionColumnHelper::view($url,$model,'entity/entity-fields');
                    },
                    'update'=>function ($url, $model) {
                        return ActionColumnHelper::update($url,$model,'entity/entity-fields');
                    },
                    'delete'=>function ($url, $model) {
                        return ActionColumnHelper::delete($url,$model,'entity/entity-fields');
                    },
                    'add'=>function ($url, $model) {
                        if($model->entity->added > 0 && $model->added > 0){
                            return '<span class="glyphicon glyphicon-ok"></span>';
                        }elseif($model->entity->added > 0 && $model->added < 1) {
                            return ActionColumnHelper::standard($url, $model, 'entity/entity-fields', 'add', 'Add column to table', 'glyphicon glyphicon-plus');
                        }elseif($model->entity->added < 1 && $model->added < 1){
                            return '<span class="glyphicon glyphicon-minus"></span>';
                        }
                    },
                ],

            ],
        ],
    ]); ?>

</div>