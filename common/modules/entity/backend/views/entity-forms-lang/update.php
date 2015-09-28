<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\modules\entity\common\models\EntityFormsLang */

$this->title = 'Update Entity Forms Lang: ' . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Entity Types', 'url' => ['/entity/entity-types/index']];
$this->params['breadcrumbs'][] = ['label' => $model->main0->entity->title, 'url' => ['/entity/entity-types/view?id='.$model->main0->entity_id.'&tab=3']];
$this->params['breadcrumbs'][] = ['label' => $model->main0->title, 'url' => ['/entity/entity-types/view?id='.$model->main.'&tab=2']];
//$this->params['breadcrumbs'][] = ['label' => 'Entity Forms Langs', 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="entity-forms-lang-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
