<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\modules\entity\common\models\smi\SmiReestResonLinkSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Smi Reest Reson Links';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="smi-reest-reson-link-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Smi Reest Reson Link', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'smi_reestr_id',
            'smi_reason_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
