<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\modules\entity\common\models\EntityForms */

$this->title = 'Create Entity Forms';
$this->params['breadcrumbs'][] = ['label' => 'Entity Types', 'url' => ['/entity/entity-types/index']];
$this->params['breadcrumbs'][] = ['label' => 'Entity #'. $model->entity_id, 'url' => ['/entity/entity-types/view?id='.$model->entity_id.'&tab=3']];
//$this->params['breadcrumbs'][] = ['label' => 'Entity Forms', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="entity-forms-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
