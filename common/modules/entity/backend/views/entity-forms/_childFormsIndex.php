<?php
/**
 * Created by PhpStorm.
 * User: a_niyazov
 * Date: 01.09.2015
 * Time: 14:32
 */

use yii\helpers\Html;
use yii\grid\GridView;
use common\helpers\ActionColumnHelper;
use common\modules\entity\common\models\EntityFields;

/* @var $this yii\web\View */
/* @var $searchModel common\modules\entity\common\models\EntityTypesLangSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */


?>
<div class="entity-types-lang-index">
<br>

    <?= GridView::widget([
        'dataProvider' => $model->getChildFormsAdp(),
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'title',
            'code',
        ],
    ]); ?>

</div>
