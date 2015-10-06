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
        <?= Html::a('Add Entity Type', ['inaction-entity/create', 'parent_id' => $model->id], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $model->getInActionEntityLinksAdp(),
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'entity_type_id',
            [
                'attribute' => 'entity_type_id',
                'value' => function($model){
                    return $model->entityType->title;
                }
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'template'=>'{view} {update} {delete} ',
                'buttons'=>[
                    'view'=>function ($url, $model) {
                        return ActionColumnHelper::view($url,$model,'epigu/inaction-entity');
                    },
                    'update'=>function ($url, $model) {
                        return ActionColumnHelper::update($url,$model,'epigu/inaction-entity');
                    },
                    'delete'=>function ($url, $model) {
                        return ActionColumnHelper::delete($url,$model,'epigu/inaction-entity');
                    },
                ],

            ],
        ],
    ]); ?>

</div>