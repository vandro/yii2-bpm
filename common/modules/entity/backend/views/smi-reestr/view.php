<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\bootstrap\Tabs;

/* @var $this yii\web\View */
/* @var $model common\modules\entity\common\models\smi\SmiReestr */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Smi Reestrs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="smi-reestr-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= Tabs::widget([
        'items' => [
            [
                'label' => 'ОАВ',
                'content' => DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        'id',
                        [
                            'attribute' => 'type_id',
                            'value' => !empty($model->type)?$model->type->title:'',
                        ],
                        'title',
                        'begin_at',
                        'frequency_period',
                        [
                            'attribute' => 'frequency_times',
                            'value' => !empty($model->frequency_times)?$model->frequency_times.' марта':'',
                        ],
                        [
                            'attribute' => 'region_id',
                            'value' => !empty($model->region)?$model->region->title:'',
                        ],
                        'address:ntext',
                        'chief_editor_full_name',
                        'phones:ntext',
                        'certificate_number',
                    ],
                ]),
                'active' => ($tab == 1),
            ],
            [
                'label' =>'Тиллари',
                'content' => $this->render('_languagesIndex', [
                    'model' => $model,
                ]),
                'active' => ($tab == 2),
            ],
            [
                'label' =>'Муассислар',
                'content' => $this->render('_foundersIndex', [
                    'model' => $model,
                ]),
                'active' => ($tab == 3),
            ],
            [
                'label' =>'Ихтисослашуви',
                'content' => $this->render('_specializationIndex', [
                    'model' => $model,
                ]),
                'active' => ($tab == 5),
            ],
//            [
//                'label' =>'Translate',
//                'content' => $this->render('_langIndex', [
//                    'model' => $model,
//                ]),
//                'active' => ($tab == 2),
//            ],
//            [
//                'label' =>'Items',
//                'content' => $this->render('_itemsIndex', [
//                    'model' => $model,
//                ]),
//                'active' => ($tab == 6),
//            ],
        ],
    ]);?>

</div>
