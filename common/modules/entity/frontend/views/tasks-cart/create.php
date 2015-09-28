<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\modules\entity\common\models\TasksCart */

$this->title = Yii::t('app', 'Создание - '.$model->process->title);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tasks'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tasks-cart-create">

    <div class="panel panel-default">
        <div class="panel-heading">
            <h2 class="panel-title"><?= Html::encode($this->title) ?></h2>
        </div>
        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>
    </div>

</div>
