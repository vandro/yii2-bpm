<?php
/**
 * Created by PhpStorm.
 * User: a_niyazov
 * Date: 09.10.2015
 * Time: 17:08
 */
//use yii;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\bootstrap\Modal;
use yii\widgets\Pjax;
$this->registerJs(
    '$("document").ready(function(){
        $("#main-submit-button").attr("onclick", "submitChildForm(\'child-node-form\')");
    });'
);
?>

<?php $form = ActiveForm::begin([
    'options' => [
        'id' => 'child-node-form',
        'data-pjax' => true,
    ]
]); ?>

    <?=$childForm->render($form, $entity)?>

<?php ActiveForm::end(); ?>

<script>
    function submitChildForm(formId)
    {
        var action = "<?=Yii::$app->urlManager->createUrl('/bpm/actions-cart/createChildGoToNextNode')?>?action_id=<?=$action_id?>&task_id=<?=$task_id?>&form_id=<?=$childForm->id?>";
        var form = $('#'+formId);
        form.attr("action", action);
        form.submit();
    }
</script>