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
            [
                'label' =>'Add fields to entity type',
                'content' => $this->render('_addFieldsIndex', [
                    'model' => $model,
                ]),
                'active' => ($tab == 3),
            ],
        ],
    ]);?>

</div>
