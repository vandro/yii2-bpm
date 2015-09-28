<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\modules\entity\common\models\EntityViews */

$this->title = Yii::t('app', 'Create Entity Views');
$this->params['breadcrumbs'][] = ['label' => 'Entity Types', 'url' => ['/entity/entity-types/index']];
$this->params['breadcrumbs'][] = ['label' => $model->entity->title, 'url' => ['/entity/entity-types/view?id='.$model->entity_id.'&tab=5']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="entity-views-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
