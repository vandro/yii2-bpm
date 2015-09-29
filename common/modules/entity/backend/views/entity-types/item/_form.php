<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\factories\DictionaryItemFactory;
use backend\models\Dictionary;

/* @var $this yii\web\View */
/* @var $model backend\models\Entity */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="entity-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php
        foreach($model->fields as $field) {
//            if($field->visible) {
//                if (empty($field->dictionary_id)) {
                    if ($field->type == 'VARCHAR') {
                        echo $form->field($itemModel, $field->code)->textInput(['maxlength' => $field->length]);
                    } elseif ($field->type == 'TEXT') {
                        echo $form->field($itemModel, $field->code)->textarea(['rows' => 6]);
                    } else {
                        echo $form->field($itemModel, $field->code)->textInput(['maxlength' => true]);
                    }
//                } else {
//                    $dictionaryItemModel = DictionaryItemFactory::getInstance(Dictionary::findOne($field->dictionary_id));
//                    echo $form->field($itemModel, $field->code)->dropDownList(ArrayHelper::map($dictionaryItemModel::find()->all(), 'id', 'title'), ['prompt' => ' -- Выберите ' . $field->title . ' --']);
//                }
//            }
        }
    ?>

    <div class="form-group">
        <?= Html::submitButton($itemModel->isNewRecord ? 'Create' : 'Update', ['class' => $itemModel->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
