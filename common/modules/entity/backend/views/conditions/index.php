<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\modules\entity\common\models\permission\NodesConditionsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Nodes Conditions');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="nodes-conditions-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Nodes Conditions'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'node_id',
            'next_execution_type',
            'true_action_id',
            'false_action_id',
            // 'true_condition_id',
            // 'false_condition_id',
            // 'operator',
            // 'operand_1_entity_id',
            // 'operand_1_field_id',
            // 'operand_2',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
