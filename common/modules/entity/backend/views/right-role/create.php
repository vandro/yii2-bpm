<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\modules\entity\common\models\RightRoleLinks */

$this->title = Yii::t('app', 'Create Right Role Links');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Right Role Links'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="right-role-links-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
