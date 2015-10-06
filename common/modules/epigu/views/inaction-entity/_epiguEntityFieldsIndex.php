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
        <?= Html::a('Add Entity Type', ['epigu-entity-fields/create', 'parent_id' => $model->id], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $model->getEpiguAndEntityFieldsLinksAdp(),
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'epigu_service_id',
                'value' => function($model){
                    return !empty($model->epiguService)?$model->epiguService->title:'';
                }
            ],
            [
                'attribute' => 'epigu_service_field_id',
                'value' => function($model){
                    return !empty($model->epiguServiceField)?$model->epiguServiceField->label_ru:'';
                }
            ],
            [
                'attribute' => 'entity_type_id',
                'value' => function($model){
                    return !empty($model->entityType)?$model->entityType->title:'';
                }
            ],
            [
                'attribute' => 'entity_type_fields_id',
                'value' => function($model){
                    return !empty($model->entityTypeField)?$model->entityTypeField->title:'';
                }
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template'=>'{view} {update} {delete} ',
                'buttons'=>[
                    'view'=>function ($url, $model) {
                        return ActionColumnHelper::view($url,$model,'epigu/epigu-entity-fields');
                    },
                    'update'=>function ($url, $model) {
                        return ActionColumnHelper::update($url,$model,'epigu/epigu-entity-fields');
                    },
                    'delete'=>function ($url, $model) {
                        return ActionColumnHelper::delete($url,$model,'epigu/epigu-entity-fields');
                    },
                ],

            ],
        ],
    ]); ?>

</div>