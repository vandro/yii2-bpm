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
        <?= Html::a('Create process Node', ['uod-link/create', 'parent_id' => $model->id], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $model->getOrganizationDepartmentsAdp(),
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'organisation_id',
                'value' => function($model){
                    return !empty($model->organisation)?$model->organisation->title:'';
                }
            ],

            [
                'attribute' => 'department_id',
                'value' => function($model){
                    return !empty($model->department)?$model->department->title:'';
                }
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'template'=>'{view} {update} {delete}',
                'buttons'=>[
                    'view'=>function ($url, $model) {
                        return ActionColumnHelper::view($url,$model,'entity/uod-link');
                    },
                    'update'=>function ($url, $model) {
                        return ActionColumnHelper::update($url,$model,'entity/uod-link');
                    },
                    'delete'=>function ($url, $model) {
                        return ActionColumnHelper::delete($url,$model,'entity/uod-link');
                    },
                ],

            ],
        ],
    ]); ?>

</div>
