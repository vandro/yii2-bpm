<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\modules\entity\common\models\smi\SmiDistributionRegionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Smi Distribution Regions';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="smi-distribution-region-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Smi Distribution Region', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'smi_reest_id',
            'region_id',
            'city_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
