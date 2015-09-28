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
        <?= Html::a('Add column', ['gridview-fields/create', 'parent_id' => $model->id, 'action' => Yii::$app->request->get('action')], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $model->getFieldsAdp(),
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
            [
                'attribute' => 'entity_type_id',
                'value' => function($model){
                    return $model->entityType->title;
                }
            ],
            [
                'attribute' => 'field_id',
                'value' => function($model){
                    return $model->field->title;
                }
            ],
            'condition',
            'value',
            'order',

            [
                'class' => 'yii\grid\ActionColumn',
                'template'=>'{view} {update} {delete}',
                'buttons'=>[
                    'view'=>function ($url, $model) {
                        return ActionColumnHelper::view($url,$model,'bpm/gridview-fields');
                    },
                    'update'=>function ($url, $model) {
                        return ActionColumnHelper::update($url,$model,'bpm/gridview-fields');
                    },
                    'delete'=>function ($url, $model) {
                        return ActionColumnHelper::delete($url,$model,'bpm/gridview-fields');
                    },
                ],
            ],
        ],
    ]); ?>

</div>