<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\modules\epigu\models\ActionHandlerLinkSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Action Handler Links');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="action-handler-link-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Action Handler Link'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'action_id',
            'handler_id',
            'settings:ntext',
            'type',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
