<?php

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>One window cabinet!</h1>

        <p class="lead">The responsible persons' cabinet application.</p>

    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-4">
                <h2>Registering mass media</h2>

                <p>You can register any mass media organisation.</p>

                <p><a class="btn btn-default" href="<?=Yii::$app->getUrlManager()->createUrl(['bpm/tasks-cart/create?id=1']);?>">Register mass media &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Licensing of mass media</h2>

                <p>You can licensing any mass media organisation.</p>

                <p><a class="btn btn-default" href="<?=Yii::$app->getUrlManager()->createUrl(['bpm/tasks-cart/create?id=3']);?>">Licensing of mass media &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Registring publishing house</h2>

                <p>You can register any publishing organisation.</p>

                <p><a class="btn btn-default" href="<?=Yii::$app->getUrlManager()->createUrl(['bpm/tasks-cart/create?id=3']);?>">Register publishing house &raquo;</a></p>
            </div>
        </div>

    </div>
</div>
