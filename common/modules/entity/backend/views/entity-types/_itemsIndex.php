<?php
/**
 * Created by PhpStorm.
 * User: a_niyazov
 * Date: 18.08.2015
 * Time: 13:11
 */
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use common\helpers\ActionColumnHelper;

$columns = $model->getItemFieldsForGridView();
$columns[] = [
    'class' => 'yii\grid\ActionColumn',
    'template'=>'{view} {update} {delete}',
    'buttons'=>[
        'view'=>function ($url, $model) {
            $customUrl = Yii::$app->getUrlManager()->createUrl(['entity/item-view','id'=>$model['id'], 'item_id' => Yii::$app->request->get('id')]);
            return Html::a( '<span class="glyphicon glyphicon-eye-open"></span>', $customUrl, ['title' => Yii::t('yii', 'View'), 'data-pjax' => 0]);
        },
        'update'=>function ($url, $model) {
            $customUrl = Yii::$app->getUrlManager()->createUrl(['entity/item-update','id'=>$model['id'], 'item_id' => Yii::$app->request->get('id')]);
            return Html::a( '<span class="glyphicon glyphicon-pencil"></span>', $customUrl, ['title' => Yii::t('yii', 'Update'), 'data-pjax' => 0]);
        },
        'delete'=>function ($url, $model) {
            $customUrl = Yii::$app->getUrlManager()->createUrl(['entity/item-delete','id'=>$model['id'], 'item_id' => Yii::$app->request->get('id')]);
            return Html::a( '<span class="glyphicon glyphicon-trash"></span>', $customUrl, ['title' => Yii::t('yii', 'Delete'), 'data-pjax' => 0]);
        },
    ],

];
$itemModel = $model->getItemSearchModel();
?>
<?php if($model->added > 0){?>
    <div class="fields-index">
        <br>
        <p>
            <?= Html::a('Create Item', ['entity/item-create', 'id' => $model->id], ['class' => 'btn btn-success']) ?>
        </p>

        <?= GridView::widget([
//            'dataProvider' => $model->getItemAdp(),
//            'filterModel' => $model->getItemSearchModel(),
            'dataProvider' => $itemModel->search(),
            'filterModel' => $itemModel,
            'columns' => $columns,
        ]); ?>

    </div>
<?php }else{ ?>
    <br>
   There are no models;
<?php }?>