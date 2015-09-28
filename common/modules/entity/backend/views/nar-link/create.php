<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\modules\entity\common\models\NodeActionRoleLink */

$this->title = Yii::t('app', 'Create Node Action Role Link');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Node Action Role Links'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="node-action-role-link-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
