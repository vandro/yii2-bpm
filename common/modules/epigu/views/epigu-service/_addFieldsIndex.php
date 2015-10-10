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
use yii\helpers\ArrayHelper;
use common\modules\entity\common\models\EntityTypes;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel common\modules\entity\common\models\EntityFormsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$entity_type_id = Yii::$app->request->post('entity_type_id');
$entity_type_id = empty($entity_type_id)?Yii::$app->request->get('entity_type_id'):$entity_type_id;
?>
<div class="entity-forms-index">
    <br>



<!--        <form class="form-inline" action="/add-entity-fields" method="get">-->
            <?php $form = ActiveForm::begin(); ?>
                <?= Html::hiddenInput('id',$model->id)?>
                <div class="form-group">
                    <?= Html::dropDownList('entity_type_id', $entity_type_id, ArrayHelper::map(EntityTypes::find()->all(), 'id', 'title'),['prompt' => '-- Choose entity type --','class' => 'form-control'])?>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-default">Select fields</button>
                    <button type="button" class="btn btn-default" onclick="addFieldsToEntity()">Add fields</button>
                </div>
             <?php ActiveForm::end(); ?>
<!--        </form>-->

    <?= GridView::widget([
        'dataProvider' => !empty($entity_type_id)?$model->getNotInEntityFieldsAdp($entity_type_id):$model->getFieldsAdp(),
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'header' => 'Выбрать',
                'format' => 'raw',
                'value' => function($model){
                    return Html::checkbox('id', false,
                        [
                            'class' => 'service-fields',
                            'value' => $model->id, //$('input:checked')[1].value
                        ]
                    );
                }
            ],
            'name',
            'label_ru',
        ],
    ]); ?>

</div>
<script>
    function addFieldsToEntity(){
        var items = $('input:checked');
        var fieldsIds = Array();

        for (var i = 0; i<items.length; i++){
            fieldsIds[i]=items[i].value;
        }

        $.ajax({
            method: "POST",
            url:"<?=Yii::$app->getUrlManager()->createUrl(['epigu/epigu-service/add-fields-to-entity','entity_type_id' => $entity_type_id,'id' => Yii::$app->request->get('id'), 'tab' => 3])?>",
            data:{"fields":fieldsIds}
        }).done(function(respond){
            alert('Добавленны поля: ' + respond.toString());
            window.location.replace('<?=Yii::$app->getUrlManager()->createUrl(['epigu/epigu-service/view','entity_type_id' => $entity_type_id,'id' => Yii::$app->request->get('id'), 'tab' => 3])?>');
        }).fail(function( jqXHR, textStatus ) {
            alert( "Request failed: " + textStatus );
            console.log(jqXHR);

        });
    }
</script>