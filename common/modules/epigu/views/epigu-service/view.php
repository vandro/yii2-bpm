<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\bootstrap\Tabs;
use yii\helpers\ArrayHelper;
use common\modules\entity\common\models\EntityTypes;

/* @var $this yii\web\View */
/* @var $model common\modules\epigu\models\EpiguService */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Epigu Services'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="epigu-service-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>
<!--    <form class="form-inline" action="add-entity-fields" method="get">-->
<!--        --><?//= Html::hiddenInput('id',$model->id)?>
<!--        <div class="form-group">-->
<!--            --><?//= Html::dropDownList('entity_type_id', '', ArrayHelper::map(EntityTypes::find()->all(), 'id', 'title'),['prompt' => '-- Choose entity type --','class' => 'form-control'])?>
<!--        </div>-->
<!--        <div class="form-group">-->
<!--            <button type="submit" class="btn btn-default">Add fields</button>-->
<!--        </div>-->
<!--    </form>-->

    <br>
    <?= Tabs::widget([
        'items' => [
            [
                'label' => 'Service',
                'content' => DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        'id',
                        'epugi_id',
                        'title',
                        'code',
                    ],
                ]),
                'active' => ($tab == 1),
            ],
            [
                'label' =>'Fields',
                'content' => $this->render('_fieldsIndex', [
                    'model' => $model,
                ]),
                'active' => ($tab == 2),
            ],
        ],
    ]);?>

</div>
