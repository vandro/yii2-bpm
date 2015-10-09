<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\modules\epigu\models\EpiguServiceFiledsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Epigu Service Fileds');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="epigu-service-fileds-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Epigu Service Fileds'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'epigu_service_id',
            'epigu_fileld_id',
            'name',
            'group:ntext',
            // 'label_ru',
            // 'label_uz',
            // 'label_en',
            // 'description_ru',
            // 'description_uz',
            // 'description_en',
            // 'has_group',
            // 'type',
            // 'depend',
            // 'has_dependents',
            // 'is_default',
            // 'disabled',
            // 'defaultValue',
            // 'api',
            // 'validators',
            // 'step',
            // 'mode',
            // 'inResult',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
