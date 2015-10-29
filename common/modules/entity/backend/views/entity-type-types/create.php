<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\modules\entity\common\models\EntityTypeTypes */

$this->title = Yii::t('app', 'Create Entity Type Types');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Entity Type Types'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="entity-type-types-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
