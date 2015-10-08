<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\modules\entity\common\models\EntityChildFormSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Entity Child Forms');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="entity-child-form-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Entity Child Form'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'parent_form_id',
            'entity_type_id',
            'foreign_key_field_id',
            'title',
            // 'code',
            // 'widget',
            // 'options:ntext',
            // 'html:ntext',
            // 'added',
            // 'mode',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
