<?php
/**
 * Created by PhpStorm.
 * User: a_niyazov
 * Date: 09.10.2015
 * Time: 17:08
 */
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\bootstrap\Modal;
use yii\grid\GridView;
?>
<?php $dictionary = $childForm->linkFieldDictionary;?>
<?php if($dictionary){?>
    <?=GridView::widget([
        'summary' => '',
        'dataProvider' => $dictionary->model->search(\Yii::$app->request->queryParams, 5),
        'filterModel' => $dictionary->model->searchModel(),
        'columns' => $dictionary->fieldsForGridView,
    ]);?>
    <?=$dictionary->form->getAddButton()?>
<?php } ?>


<?php $form = ActiveForm::begin([
    'options' => [
        'id' => 'child-node-form',
    ]
]); ?>

    <?php Modal::begin([
        'id' => $dictionary->form->code,
        'header' => '<b>' . Yii::t('app', $childForm->title) . '</b>',
            'footer' => Html::button('Создать' ,
                [
                    'class' => 'btn btn-default',
                    'onclick' => "submitChildTableElement('child-node-form')",
                ]
            ),
    ]);?>
        <?=$dictionary->form->render($form, $dictionary->form->entityType)?>
    <?php Modal::end();?>

<?php ActiveForm::end(); ?>

<script>
    function selectElement(link_id){
        var action = "<?=Yii::$app->urlManager->createUrl('/bpm/actions-cart/createChildLink')?>?action_id=<?=$action_id?>&task_id=<?=$task_id?>&form_id=<?=$childForm->id?>&parent_id=<?=$parentEntity->id?>&link_id="+link_id;
        $.ajax({ url: action, type: 'get' });
    }

    function submitChildTableElement(formId)
    {
        var action = "<?=Yii::$app->urlManager->createUrl('/bpm/actions-cart/createChildTableElement')?>?action_id=<?=$action_id?>&task_id=<?=$task_id?>&form_id=<?=$dictionary->form->id?>";
        var form = $('#'+formId); form.attr("action", action); form.submit();
    }
</script>