<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\modules\entity\common\models\ProcessesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Services');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="processes-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'title',
            //'code',
            [
                'format' => 'html',
                'value' => function($model){
                    $customUrl = Yii::$app->getUrlManager()->createUrl('bpm/tasks-cart/create?id='.$model->id);
                    return Html::a( '<span class="glyphicon glyphicon-plus"></span>', $customUrl,
                        ['title' => Yii::t('yii', 'Create'), 'data-pjax' => 0, 'class' => 'btn btn-default']);
                }
            ],

//            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
