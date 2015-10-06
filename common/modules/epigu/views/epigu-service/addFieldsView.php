<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\bootstrap\Tabs;
use yii\helpers\ArrayHelper;
use common\modules\entity\common\models\EntityTypes;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\modules\epigu\models\EpiguService */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Epigu Services'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
//$this->registerJsFile('/admin/js/multiselect.js');
?>
<div class="epigu-service-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin(); ?>
    <?php foreach($model->fields as $field){?>
        <?=Html::activeCheckbox($field, 'label_ru')?>
    <?php }?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>


    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-xs-5">
            <?= Html::dropDownList('accessFields',
                '',
                $model->getAllFields($entityType),
                [
                    'multiple'=>'multiple',
                    'class'=>'multiselect form-control',
                    'size' => 8,
                    'id' => 'multiselect',
                ])
            ?>
        </div>

        <div class="col-xs-2">
            <button type="button" id="multiselect_rightSelected" class="btn btn-block"><i class="glyphicon glyphicon-chevron-right"></i></button>
            <button type="button" id="multiselect_leftSelected" class="btn btn-block"><i class="glyphicon glyphicon-chevron-left"></i></button>
        </div>

        <div class="col-xs-5">
            <?= Html::dropDownList('availableFields',
                '',
                $entityType->allFields,
                [
                    'multiple'=>'multiple',
                    'class'=>'form-control',
                    'size' => 8,
                    'id' => 'multiselect_to'

                ])
            ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<script type="text/javascript">
    jQuery(document).ready(function(jQuery) {
        jQuery('#multiselect').multiselect(
            {
                beforeMoveToLeft: function ($left, $right, options) {
                    var items = new Array();
                    var result = false;
                    for (var i = 0; i<options.length; i++){
                        items[i]=$(options[i].outerHTML).attr('value');
                    }
                    $.ajax({
                        method: "POST",
                        url:"<?=Yii::$app->getUrlManager()->createUrl(['epigu-service/add-entity-type-field','entity_type_id'=>$entityType->id,'service_field_id'=>$model->id ])?>//",
                        data:{"fields":items},
                        async:false
                    }).done(function(respond){
                        result = (parseInt(respond) == 200);
                    }).fail(function( jqXHR, textStatus ) {
                        alert( "Request failed: " + textStatus );
                        console.log(jqXHR);
                        result=false;
                    });
                    return result;
                },
                beforeMoveToRight: function ($left, $right, options) {
                    var items = new Array();
                    var result = false;
                    for (var i = 0; i<options.length; i++){
                        items[i]=$(options[i].outerHTML).attr('value');
                    }
                    $.ajax({
                        method: "POST",
                        url:"<?=Yii::$app->getUrlManager()->createUrl(['epigu-service/remove-entity-type-field','entity_type_id'=>$entityType->id,'service_field_id'=>$model->id ])?>",
                        data:{"fields":items},
                        async:false
                    }).done(function(respond){
                        result = (parseInt(respond) == 200);
                    }).fail(function( jqXHR, textStatus ) {
                        alert( "Request failed: " + textStatus );
                        console.log(jqXHR);
                        result=false;
                    });
                    return result;
                },
                startUp: function( $left, $right ) {
                }
            }
        );
    });
</script>
