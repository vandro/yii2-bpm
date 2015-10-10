<?php
/**
 * Created by PhpStorm.
 * User: a_niyazov
 * Date: 01.09.2015
 * Time: 15:14
 */

use yii\helpers\Html;
use yii\grid\GridView;
use common\helpers\ActionColumnHelper;

/* @var $this yii\web\View */
/* @var $searchModel common\modules\entity\common\models\EntityFormsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

?>
<div class="entity-forms-index">
    <br>

    <p>
        <?= Html::a('Add Field', ['epigu-service-fileds/create', 'parent_id' => $model->id], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Add All Fields From Service Config', ['epigu-service/add-fields', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Remove All Fields', ['epigu-service/delete-fields', 'id' => $model->id], ['class' => 'btn btn-danger']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $model->getFieldsAdp(),
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'name',
            'label_uz',
            'group',
            'type',
            [
                'class' => 'yii\grid\ActionColumn',
                'template'=>'{view} {update} {delete} ',
                'buttons'=>[
                    'view'=>function ($url, $model) {
                        return ActionColumnHelper::view($url,$model,'epigu/epigu-service-fileds');
                    },
                    'update'=>function ($url, $model) {
                        return ActionColumnHelper::update($url,$model,'epigu/epigu-service-fileds');
                    },
                    'delete'=>function ($url, $model) {
                        return ActionColumnHelper::delete($url,$model,'epigu/epigu-service-fileds');
                    },
                ],

            ],
        ],
    ]); ?>

</div>