<?php
/**
 * Created by PhpStorm.
 * User: a_niyazov
 * Date: 04.10.2015
 * Time: 11:42
 *
 */
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
$this->registerJs(
    '$("document").ready(function(){
        $("#main-submit-button").attr("onclick", "submitAssignForm()");
    });'
);
?>

<div class="row">
    <div class="col-xs-12">
        <?=Html::dropDownList('executor',null,ArrayHelper::map($executors, 'id', 'username'),[
            "prompt" => " -- Выполните исполнителя -- ",
            "class" => "form-control",
            "style" => "",
            "id" => "executor",
        ])?>
    </div>
</div>
<script>
    function submitAssignForm()
    {
        var executor_id = $( "#executor" ).val();
        var action = "<?=Yii::$app->urlManager->createUrl('/executor/do/assign')?>?task_id=<?=$task_id?>&executor_id="+executor_id;
        $.ajax({
            url: action,
            type: 'get',
            success: function (result) {
                //if(result.status) {
                    submitForm();
                //}
            }
        });
    }
</script>
