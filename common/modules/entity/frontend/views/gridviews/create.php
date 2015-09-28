<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\modules\entity\common\models\permission\Gridviews */

$this->title = Yii::t('app', 'Create Gridviews');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tasks'), 'url' => ['tasks-cart/'.$actionName, 'views_id' => $model->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gridviews-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
