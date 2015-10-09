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
        <?= Html::a('Add reason', ['smi-distribution-region/create', 'parent_id' => $model->id], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $model->getDistributionRegionsAdp(),
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'region_id',
                'value' => function($model){
                    return !empty($model->region)?$model->region->title:'';
                }
            ],
            [
                'attribute' => 'city_id',
                'value' => function($model){
                    return !empty($model->city)?$model->city->title:'';
                }
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template'=>'{view} {update} {delete} ',
                'buttons'=>[
                    'view'=>function ($url, $model) {
                        return ActionColumnHelper::view($url,$model,'entity/smi-distribution-region');
                    },
                    'update'=>function ($url, $model) {
                        return ActionColumnHelper::update($url,$model,'entity/smi-distribution-region');
                    },
                    'delete'=>function ($url, $model) {
                        return ActionColumnHelper::delete($url,$model,'entity/smi-distribution-region');
                    },
                ],

            ],
        ],
    ]); ?>

</div>