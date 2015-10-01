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

<!--    --><?//= GridView::widget([
//        'dataProvider' => $model->getConditionsAdp(),
//        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],
//            'id',
//            [
//                'header' => 'Условие',
//                'format' => 'html',
//                'value' => function($model){
//                    return $model->title;
//                }
//            ],
//            [
//                'attribute' => 'true_next_exec_type',
//                'header' => 'Следующее действие',
//                'value' => function($model){
//                    return ($model->true_next_exec_type == 'action')?'Вызов действия':"Проверка следующего условия";
//                }
//            ],
//            [
//                'attribute' => 'false_next_exec_type',
//                'header' => 'Следующее действие',
//                'value' => function($model){
//                    return ($model->false_next_exec_type == 'action')?'Вызов действия':"Проверка следующего условия";
//                }
//            ],
//            [
//                'attribute' => 'true_action_id',
//                'header' => 'Действие истина',
//                'format' => 'html',
//                'value' => function($model){
//                    if(!empty($model->trueAction)) {//&& $model->true_next_exec_type == 'action') {
//                        return $model->trueAction->title;
//                    }
//                }
//            ],
//            [
//                'attribute' => 'false_action_id',
//                'header' => 'Действие ложь',
//                'format' => 'html',
//                'value' => function($model){
//                    if(!empty($model->falseAction)) { // && $model->false_next_exec_type == 'action') {
//                        return $model->falseAction->title;
//                    }
//                }
//            ],
//            [
//                'attribute' => 'true_condition_id',
//                'header' => 'Условие истина',
//                'format' => 'html',
//                'value' => function($model){
//                    if(!empty($model->trueCondition)) { //  && $model->true_next_exec_type == 'condition') {
//                        return $model->trueCondition->title;
//                    }
//                }
//            ],
//            [
//                'attribute' => 'false_condition_id',
//                'header' => 'Условие ложь',
//                'format' => 'html',
//                'value' => function($model){
//                    if(!empty($model->falseCondition)) { //  && $model->false_next_exec_type == 'condition') {
//                        return $model->falseCondition->title;
//                    }
//                }
//            ],
//            [
//                'class' => 'yii\grid\ActionColumn',
//                'template'=>'{view} {update} {delete}',
//                'buttons'=>[
//                    'view'=>function ($url, $model) {
//                        return ActionColumnHelper::view($url,$model,'entity/conditions');
//                    },
//                    'update'=>function ($url, $model) {
//                        return ActionColumnHelper::update($url,$model,'entity/conditions');
//                    },
//                    'delete'=>function ($url, $model) {
//                        return ActionColumnHelper::delete($url,$model,'entity/conditions');
//                    },
//                ],
//
//            ],
//        ],
//    ]); ?>

</div>

<!--<ul>-->
<!--    --><?php //foreach($model->conditions as $condition){ ?>
<!--        <li style="font-size: large; list-style: none;"><var style="color: blue;">если</var> ( --><?//=$condition->title?><!-- ) <var style="color: blue;">тогда </var>{-->
<!--            --><?php //if($condition->true_next_exec_type == 'condition') {?>
<!--                --><?//=!empty($condition->trueCondition)?$condition->trueCondition->title:''?>
<!--                --><?//=$condition->getTrueActionAddUrl()?>
<!---->
<!--            --><?php //}else{ ?>
<!--                --><?//=!empty($condition->trueAction)?$condition->trueAction->title:''?>
<!--                --><?//=$condition->getTrueConditionAddUrl()?>
<!--            --><?php //} ?>
<!--            <var>} <var style="color: blue;">иначе</var> {</var>-->
<!--            --><?//=$condition->getFalseConditionAddUrl()?>
<!--            --><?//=$condition->getFalseActionAddUrl()?>
<!--            <var>}</var>-->
<!--            --><?//=$condition->getDeleteUrl()?>
<!--        </li>-->
<!--    --><?php //} ?>
<!--</ul>-->

<?php foreach($model->conditions as $condition){ ?>
    <?php if(!$condition->hasParent()){?>
        <?=$condition->render()?>
        <hr style="border-color: #002240">
    <?php } ?>
<?php } ?>