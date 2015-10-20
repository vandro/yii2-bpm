<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\helpers\ActionColumnHelper;

/* @var $this yii\web\View */
/* @var $searchModel common\modules\entity\common\models\EntityTypesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Entity Types';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="entity-types-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Entity Type', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Delete Generated', ['delete-generated'], ['class' => 'btn btn-default']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            'code',

//            ['class' => 'yii\grid\ActionColumn'],
            [
                'class' => 'yii\grid\ActionColumn',
                'template'=>'{list} {view} {update} {delete} ',
                'buttons'=>[
                    'view'=>function ($url, $model) {
                        return ActionColumnHelper::view($url,$model,'entity/entity-types');
                    },
                    'update'=>function ($url, $model) {
                        return ActionColumnHelper::update($url,$model,'entity/entity-types');
                    },
                    'delete'=>function ($url, $model) {
                        return ActionColumnHelper::delete($url,$model,'entity/entity-types');
                    },
                    'list'=>function ($url, $model) {
                        return ActionColumnHelper::standard($url, $model, 'entity/entity-data', 'index', 'Data List', 'glyphicon glyphicon-list');
                    },
                ],

            ],
        ],
    ]); ?>

</div>
