<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\modules\epigu\models\EpiguAndEntityFieldsLinkSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Epigu And Entity Fields Links');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="epigu-and-entity-fields-link-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Epigu And Entity Fields Link'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'in_action_entity_link_id',
            'epigu_service_id',
            'epigu_service_field_id',
            'entity_type_id',
            // 'entity_type_fields_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
