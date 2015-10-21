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