<?php
/**
 * Created by PhpStorm.
 * User: a_niyazov
 * Date: 20.10.2015
 * Time: 15:17
 */
use yii\grid\GridView;
use yii\widgets\Pjax;
?>

<?php Pjax::begin(['id' => 'child-grid']); ?>

<?=GridView::widget([
    'summary' => '',
    'dataProvider' => $childEntity->search(null,15),
    'columns' => $childForm->columnsForGridView,
]);?>

<?php Pjax::end(); ?>
<script>
    function deleteElement(item_id){
        var action = "<?=Yii::$app->urlManager->createUrl('/bpm/actions-cart/deleteChildLink')?>?action_id=<?=$action_id?>&task_id=<?=$task_id?>&form_id=<?=$childForm->id?>&item_id="+item_id;
        $.ajax({ url: action, type: 'get' });
    }
</script>