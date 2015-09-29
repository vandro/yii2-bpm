<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use yii\bootstrap\ButtonGroup;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'MyBPM',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-default navbar-fixed-top',
        ],
    ]);
    $menuItems = [
        ['label' => 'Home', 'url' => ['/site/index']],
//        ['label' => 'About', 'url' => ['/site/about']],
//        ['label' => 'Contact', 'url' => ['/site/contact']],
    ];
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Signup', 'url' => ['/site/signup']];
        $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
    } else {
        $services = \common\modules\entity\common\models\Processes::find()->all();
        foreach($services as $service){
            $subMenuItems[] = ['label' => Yii::t('app', $service->title), 'url' => ['/bpm/tasks-cart/create', 'id' => $service->id]];
        }
        $menuItems[] = ['label' => Yii::t('app', 'Services'), 'url' => ['/bpm/services'], 'items' => $subMenuItems];
        $menuItems[] = ['label' => Yii::t('app', 'Tasks'), 'url' => ['/bpm/tasks-cart/active']];
        $subMenuItems = [];
        $entityTypes = \common\modules\entity\common\models\EntityTypes::find()->all();
        foreach($entityTypes as $entityType){
            $subMenuItems[] = ['label' => Yii::t('app', $entityType->title), 'url' => ['/bpm/entity-data/index', 'id' => $entityType->id]];
        }
        $menuItems[] = ['label' => Yii::t('app', 'Entity Data'), 'url' => ['/bpm/entity-data'], 'items' => $subMenuItems];
        $menuItems[] = [
            'label' => 'Logout (' . Yii::$app->user->identity->username . ')',
            'url' => ['/site/logout'],
            'linkOptions' => ['data-method' => 'post']
        ];
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>

        <div class="row">
            <?php if (!Yii::$app->user->isGuest) {?>
                <div class="col-md-2">
                    <?= \valiant\widgets\ListGroupWidget::widget([
                        'options' => [
                            'class' => 'navbar-nav navbar-left',
                            'style' => 'width:110%;',
                        ],
                        'items' => [
                            ['label' => Yii::t('app', 'Active tasks'), 'url' => ['/bpm/tasks-cart/active', 'views_id' => Yii::$app->request->get('views_id')]],
                            ['label' => Yii::t('app', 'Inactive tasks'), 'url' => ['/bpm/tasks-cart/inactive', 'views_id' => Yii::$app->request->get('views_id')]],
                            ['label' => Yii::t('app', 'Closed tasks'), 'url' => ['/bpm/tasks-cart/closed', 'views_id' => Yii::$app->request->get('views_id')]],
                        ],
                    ]); ?>
                </div>
            <?php }?>
            <div class="<?=!Yii::$app->user->isGuest?'col-md-10':'col-md-12'?>">
                <?= $content ?>
            </div>
        </div>

    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
