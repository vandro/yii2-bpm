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

/* @var $this yii\web\View */
/* @var $searchModel common\modules\entity\common\models\EntityTypesLangSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

?>
<div class="entity-types-lang-index">
<br>
    <div id="mynetwork" style="height: 1000px; color: #020202"></div>

</div>

<script type="text/javascript">
    window.onload = function () {
        var nodes = new vis.DataSet(<?=$model->jsonNodesArray?>);

        var edges = new vis.DataSet(<?=$model->jsonEdgesArray?>);

        var container = document.getElementById('mynetwork');
        var data = {
            nodes: nodes,
            edges: edges
        };
        var options = {
            interaction:{hover:true},
            edges: {
                smooth: true,
                arrows: {to : true }
            }
        };
        var network = new vis.Network(container, data, options);
    }//);
</script>
