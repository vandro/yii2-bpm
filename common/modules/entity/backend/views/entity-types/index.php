<?php

use yii\helpers\Html;
use yii\grid\GridView;

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
        <?= Html::a('Create Entity Type From EPIGU Service data', ['/epigu/epigu-service/create-entity'], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            'code',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
