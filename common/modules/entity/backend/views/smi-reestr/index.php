<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\modules\entity\common\models\smi\SmiReestrSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Smi Reestrs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="smi-reestr-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Smi Reestr', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            [
                'attribute' => 'type_id',
                'filter' => $searchModel->getTypeFilter($searchModel),
                'value' => function($model){
                    return !empty($model->type)?$model->type->title:'';
                }
            ],
            'title',
            'begin_at',
            'frequency_period',
            // 'frequency_times:datetime',
            // 'address:ntext',
            // 'chief_editor_full_name',
            // 'phones:ntext',
            // 'certificate_number',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
