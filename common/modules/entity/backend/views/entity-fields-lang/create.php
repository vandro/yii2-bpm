<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\modules\entity\common\models\EntityFieldsLang */

$this->title = 'Create Entity Fields Lang';
//$this->params['breadcrumbs'][] = ['label' => 'Entity Types', 'url' => ['/entity/entity-types/index']];
//$this->params['breadcrumbs'][] = ['label' => $model->main0->entity->title, 'url' => ['/entity/entity-types/view?id='.$model->main0->entity_id.'&tab=4']];
$this->params['breadcrumbs'][] = ['label' => 'Field #'.$model->main, 'url' => ['/entity/entity-fields/view?id='.$model->main.'&tab=2']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="entity-fields-lang-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
