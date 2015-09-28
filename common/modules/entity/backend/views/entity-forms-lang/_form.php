<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\modules\languages\common\models\Language;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model common\modules\entity\common\models\EntityFormsLang */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="entity-forms-lang-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'lang')->dropDownList(ArrayHelper::map(Language::find()->all(), 'code', 'title'), ['prompt' => ' -- Выберите язык --']) ?>

    <?= $form->field($model, 'title')->textInput() ?>

    <?= $form->field($model, 'main')->hiddenInput()->label('') ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
