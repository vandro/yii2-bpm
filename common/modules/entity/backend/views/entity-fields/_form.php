<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\modules\entity\common\models\EntityTypes;

/* @var $this yii\web\View */
/* @var $model common\modules\entity\common\models\EntityFields */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="entity-fields-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput() ?>

    <?= $form->field($model, 'code')->textInput() ?>

    <?= $form->field($model, 'type')->dropDownList([
            'VARCHAR' => 'VARCHAR строка до 255 символов',
            'TEXT' => 'TEXT текст более 255 символов',
            'INT' => 'INT целое число',
            'DATE' => 'DATE дата',
        ],
        [
            'prompt' => ' -- Выберите тип поля базы данных --'
        ])
    ?>

    <?= $form->field($model, 'length')->textInput() ?>

    <?= $form->field($model, 'widget')->textInput() ?>

    <?= $form->field($model, 'options')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'dictionary_id')->dropDownList(ArrayHelper::map(EntityTypes::find()->all(), 'id', 'title'), ['prompt'=> ' -- Выберите справочник --']) ?>

    <?php if($model->added) {
        echo $form->field($model, 'added')->dropDownList([0 => 'Нет', 1 => 'Да'], ['prompt' => 'Добавить']);
    }?>

    <?= $form->field($model, 'entity_id')->hiddenInput()->label('') ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
