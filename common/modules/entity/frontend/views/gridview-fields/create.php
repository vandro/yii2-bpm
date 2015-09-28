<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\modules\entity\common\models\permission\GridviewFields */

$actionName = Yii::$app->cache->get('action'.Yii::$app->user->id);
$actionName = !empty($actionName)?$actionName:'active';

$this->title = Yii::t('app', 'Create Gridview Fields');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tasks'), 'url' => ['tasks-cart/'.$actionName, 'views_id' => $model->gridview_id]];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Gridview'), 'url' => ['gridviews/view', 'id' => $model->gridview_id, 'tab' => 2]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gridview-fields-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
