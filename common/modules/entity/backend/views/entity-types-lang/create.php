<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\modules\entity\common\models\EntityTypesLang */

$this->title = 'Create Entity Types Lang';
$this->params['breadcrumbs'][] = ['label' => 'Entity Types', 'url' => ['/entity/entity-types/index']];
$this->params['breadcrumbs'][] = ['label' => 'Entity #'. $model->main, 'url' => ['/entity/entity-types/view?id='.$model->main.'&tab=2']];
//$this->params['breadcrumbs'][] = ['label' => 'Entity Types Langs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="entity-types-lang-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
