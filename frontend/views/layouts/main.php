<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

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
        $menuItems[] = ['label' => Yii::t('app', 'Reports'), 'url' => ['/bpm/entity-data'], 'items' => [
            ['label' => Yii::t('app', 'Давлат реестрига киритилган оммавий ахборот воситаларининг умумий сони'), 'url' => ['/bpm/report/index', 'id' => 1]],
            ['label' => Yii::t('app', 'Давлатга қарашли бўлган ва қарашли бўлмаган ЭОАВ (ТВ, Радио) тўғрисида'), 'url' => ['/bpm/report/index', 'id' => 2]],
            ['label' => Yii::t('app', 'Умумий ҳисобдаги давлатга қарашли бўлган ва қарашли бўлмаган ОАВ ҳақида'), 'url' => ['/bpm/report/index', 'id' => 3]],
            ['label' => Yii::t('app', 'Йиллар бўйича ОАВ тури сифатида рўйхатга олинган ҳақида'), 'url' => ['/bpm/report/index', 'id' => 4]],
            ['label' => Yii::t('app', 'Йиллар бўйича ОАВ фалият куриниши сифатида рўйхатга олинган ҳақида'), 'url' => ['/bpm/report/index', 'id' => 5]],
            ['label' => Yii::t('app', 'ЎзМАА томонидан рўйхатга олинган ОАВ тиллар бўйича'), 'url' => ['/bpm/report/index', 'id' => 6]],
            ['label' => Yii::t('app', 'ЎзМАА томонидан рўйхатга олинган ОАВ тиллар ва худудлар бўйича'), 'url' => ['/bpm/report/index', 'id' => 7]],
        ]];
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
        <?= $content ?>
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
