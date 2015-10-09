<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model common\modules\epigu\models\EpiguService */
/* @var $form yii\widgets\ActiveForm */
?>

<?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-xs-5">
            <?= Html::dropDownList('accessFields',
                '',
                ArrayHelper::map($model->allFields, 'id','title'),
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
                ArrayHelper::map($model->step->entity->getFields()->where(
//                    '
//                    in_request = 0
//                    AND
//                    id not in (SELECT field_id FROM steps_actions_fields WHERE step_id = :step_id AND action_id = :action_id)',
                    '
                    id not in (SELECT field_id FROM steps_actions_fields WHERE step_id = :step_id AND action_id = :action_id)',

                    [':step_id' => $model->step_id, ':action_id' => $model->action_id]
                )->all(), 'id','title'),
                [
                    'multiple'=>'multiple',
                    'class'=>'form-control',
                    'size' => 8,
                    'id' => 'multiselect_to'

                ])
            ?>
        </div>

        <script type="text/javascript">
            jQuery(document).ready(function($) {
                $('#multiselect').multiselect(
                    {
                        beforeMoveToLeft: function ($left, $right, options) {
                            var items = new Array();
                            var result = false;
                            for (var i = 0; i<options.length; i++){
                                items[i]=$(options[i].outerHTML).attr('value');
                            }
                            $.ajax({
                                method: "POST",
                                url:"<?=Yii::$app->getUrlManager()->createUrl(['process-steps-actions/add-access-fields','step_id'=>$model->step_id,'action_id'=>$model->action_id ])?>",
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
                                url:"<?=Yii::$app->getUrlManager()->createUrl(['process-steps-actions/remove-access-fields','step_id'=>$model->step_id,'action_id'=>$model->action_id ])?>",
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
                        },
                    }
                )
            });
        </script>
    </div>

<?php ActiveForm::end(); ?>