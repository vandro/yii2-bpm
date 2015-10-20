<?php
/**
 * Created by PhpStorm.
 * User: a_niyazov
 * Date: 20.10.2015
 * Time: 10:52
 */
use yii\bootstrap\ActiveForm;
?>

<?php $form = ActiveForm::begin([
    'options' => [
        'id' => 'child-node-form',
    ]
]); ?>
    <div style="display: none">
        <?=$childForm->render($form, $entity)?>
    </div>
<?php ActiveForm::end(); ?>
<script>
    function selectElement(id, $field)
    {
        var form = $('#child-node-form');

        form.submit();
    }
</script>