<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\modules\entity\common\models\EntityFormsLang */

$this->title = 'Create Entity Forms Lang';
$this->params['breadcrumbs'][] = ['label' => 'Entity Form #'. $model->main, 'url' => ['/entity/entity-forms/view?id='.$model->main.'&tab=2']];
//$this->params['breadcrumbs'][] = ['label' => 'Entity Forms Langs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="entity-forms-lang-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
