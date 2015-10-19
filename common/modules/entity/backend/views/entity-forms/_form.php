<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use conquer\codemirror\CodemirrorWidget;
use conquer\codemirror\CodemirrorAsset;
use yii\web\JsExpression;

/* @var $this yii\web\View */
/* @var $model common\modules\entity\common\models\EntityForms */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="entity-forms-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput() ?>

    <?= $form->field($model, 'code')->textInput() ?>

    <?= $form->field($model, 'mode')->dropDownList(['create' => 'Create new entity item', 'update' => 'Update existed entity item', 'view' => 'View existed entity item'], ['prompt' => 'Choose form work mode']); ?>

    <?= $form->field($model, 'parent_form_id')->dropDownList($model->getAllForms(), ['prompt' => 'Choose Parent Form']); ?>

    <?= $form->field($model, 'foreign_key_field_id')->dropDownList($model->getAllEntityFields(), ['prompt' => 'Choose Foreign Key Field ID']); ?>

    <?= $form->field($model, 'settings')->textarea(['rows' => 6]) ?>

    <?php if(!empty($model->fields) || !empty($model->fields)){?>

        <?= $form->field($model, 'html')->widget(
            CodemirrorWidget::className(),
            [
                'assets'=>[
                    CodemirrorAsset::MODE_JAVASCRIPT,
                    CodemirrorAsset::MODE_HTTP,
                    CodemirrorAsset::MODE_CSS,
                    CodemirrorAsset::MODE_PHP,
                    CodemirrorAsset::MODE_XML,
                    CodemirrorAsset::MODE_HTMLMIXED,
                    CodemirrorAsset::MODE_CLIKE,
                    CodemirrorAsset::ADDON_COMMENT,
                    CodemirrorAsset::ADDON_DISPLAY_FULLSCREEN,
                    CodemirrorAsset::THEME_ECLIPSE,
                ],
                'settings'=>[
                    'lineNumbers' => true,
                    'matchBrackets' => true,
                    'mode' => "text/html", //"application/x-httpd-php-open",
                    'indentUnit' => 4,
                    'indentWithTabs' => true,
                    'extraKeys' => [
                        "F11" => new JsExpression("function(cm){cm.setOption('fullScreen', !cm.getOption('fullScreen'));}"),
                        "Esc" => new JsExpression("function(cm){if(cm.getOption('fullScreen')) cm.setOption('fullScreen', false);}"),
                    ],
                ],
            ]
        ); ?>

        Available fields codes:
        <?php foreach($model->fields as $field){
            echo ' {%'.$field->code.'%} ';
        }?>
        <br>
        Available child form codes:
        <?php foreach($model->childForms as $childForm){
            echo ' {%'.$childForm->code.'%} ';
        }?>

    <?php } ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
