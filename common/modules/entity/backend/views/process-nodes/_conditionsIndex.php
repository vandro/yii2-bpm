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
        <?= Html::a('Add conditions', ['conditions/create', 'parent_id' => $model->id], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $model->getConditionsAdp(),
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'header' => 'Условие',
                'value' => function($model){
                    return $model->title;
                }
            ],
            [
                'attribute' => 'next_execution_type',
                'header' => 'Следующее действие',
                'value' => function($model){
                    return ($model->next_execution_type == 'action')?'Вызов действия':"Проверка следующего условия";
                }
            ],
            [
                'attribute' => 'true_action_id',
                'header' => 'Действие истина',
                'value' => function($model){
                    if(!empty($model->trueAction) && $model->next_execution_type == 'action') {
                        return $model->trueAction->title;
                    }
                }
            ],
            [
                'attribute' => 'false_action_id',
                'header' => 'Действие ложь',
                'value' => function($model){
                    if(!empty($model->falseAction) && $model->next_execution_type == 'action') {
                        return $model->falseAction->title;
                    }
                }
            ],
            [
                'attribute' => 'true_condition_id',
                'header' => 'Условие истина',
                'value' => function($model){
                    if(!empty($model->trueCondition) && $model->next_execution_type == 'condition') {
                        return $model->trueCondition->title;
                    }
                }
            ],
            [
                'attribute' => 'false_condition_id',
                'header' => 'Условие ложь',
                'value' => function($model){
                    if(!empty($model->falseCondition) && $model->next_execution_type == 'condition') {
                        return $model->falseCondition->title;
                    }
                }
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template'=>'{view} {update} {delete}',
                'buttons'=>[
                    'view'=>function ($url, $model) {
                        return ActionColumnHelper::view($url,$model,'entity/conditions');
                    },
                    'update'=>function ($url, $model) {
                        return ActionColumnHelper::update($url,$model,'entity/conditions');
                    },
                    'delete'=>function ($url, $model) {
                        return ActionColumnHelper::delete($url,$model,'entity/conditions');
                    },
                ],

            ],
        ],
    ]); ?>

</div>

<ul>
    <?php foreach($model->conditions as $condition){ ?>
        <li><?=$condition->title?></li>
    <?php } ?>
</ul>
