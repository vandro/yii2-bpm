<?php

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>BPM API SYSTEM!</h1>

        <p class="lead">Administration application.</p>

    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-4">
                <h2>Entity types</h2>

                <p>You can create entity type to use it in business process.</p>

                <p><a class="btn btn-default" href="<?=Yii::$app->getUrlManager()->createUrl(['entity/entity-types/index']);?>">Entity types &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Processes</h2>

                <p>You can define business processes to manage activities of all process participants.</p>

                <p><a class="btn btn-default" href="<?=Yii::$app->getUrlManager()->createUrl(['entity/processes/index']);?>">Processes &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Actions</h2>

                <p>You can define actions to reuse in different nodes of different business processes.</p>

                <p><a class="btn btn-default" href="<?=Yii::$app->getUrlManager()->createUrl(['entity/nodes-actions/index']);?>">Actions &raquo;</a></p>
            </div>
        </div>

    </div>
</div>
