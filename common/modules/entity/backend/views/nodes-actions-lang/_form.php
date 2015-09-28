<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\modules\languages\common\models\Language;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model common\modules\entity\common\models\ProcessesLang */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="processes-lang-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'lang')->dropDownList(ArrayHelper::map(Language::find()->all(), 'code', 'title'), ['prompt' => ' -- Выберите язык --']) ?>

    <?= $form->field($model, 'title')->textInput() ?>

    <?= $form->field($model, 'main')->hiddenInput()->label('') ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
