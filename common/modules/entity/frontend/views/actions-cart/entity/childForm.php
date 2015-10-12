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
        $("#new-child-element").on("pjax:end", function() {
            $.pjax.reload({container:"#child-grid"});  //Reload GridView
        });
    });'
);
?>
<?php Pjax::begin(['id' => 'new-child-element']) ?>
<?php $form = ActiveForm::begin([
    'options' => [
        'id' => 'child-node-form',
        'data-pjax' => true,
    ]
]); ?>

    <?php Modal::begin([
        'id' => $childForm->code,
        'header' => '<b>' . Yii::t('app', $childForm->title) . '</b>',
        'footer' => Html::button('Create' ,
            [
                'class' => 'btn btn-default',
                'onclick' => "submitChildForm('child-node-form')",
            ]
        ),
    ]);?>

        <?=$childForm->render($form, $entity)?>

    <?php Modal::end();?>

<?php ActiveForm::end(); ?>
<?php Pjax::end() ?>

<script>
    function submitChildForm(formId)
    {
        var action = "<?=Yii::$app->urlManager->createUrl('/bpm/actions-cart/createChild')?>?action_id=<?=$action_id?>&task_id=<?=$task_id?>&form_id=<?=$childForm->id?>";
        var form = $('#'+formId);
        form.attr("action", action);
        form.submit();
    }
</script>