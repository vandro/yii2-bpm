<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
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
        'brandLabel' => 'MyBPM (admin app)',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-default navbar-fixed-top',
        ],
    ]);
    $menuItems = [
        ['label' => 'Home', 'url' => ['/site/index']],
    ];
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
    } else {
        $menuItems[] = ['label' => 'Entity Types', 'url' => ['/entity/entity-types/index']];
        $menuItems[] = ['label' => 'Processes', 'url' => ['/entity/processes/index']];
        $menuItems[] = ['label' => 'System',
            'items' => [
                ['label' => 'EPIGU Services', 'url' => ['/epigu/epigu-service/index']],
                ['label' => 'Integration', 'url' => ['/epigu/integration-actions/index']],
                ['label' => 'Handlers', 'url' => ['/entity/handlers/index']],
                ['label' => 'Databases', 'url' => ['/entity/databases/index']],
            ]
        ];
        $menuItems[] = ['label' => 'Users', 'url' => ['/entity/user/index']];
        $menuItems[] = ['label' => 'Roles', 'url' => ['/entity/roles/index']];
        $menuItems[] = ['label' => 'Rights', 'url' => ['/entity/rights/index']];
        $menuItems[] = ['label' => 'Organizations', 'url' => ['/entity/organizations/index']];
        $menuItems[] = ['label' => 'SMI', /*'url' => ['/entity/organizations/index'],*/
            'items' => [
                ['label' => 'Smi reestr', 'url' => ['/entity/smi-reestr/index']],
                ['label' => 'Languages', 'url' => ['/entity/languages/index']],
                ['label' => 'Smi founders', 'url' => ['/entity/smi-founders/index']],
                ['label' => 'Smi specialization', 'url' => ['/entity/smi-specialization/index']],
                ['label' => 'Smi type', 'url' => ['/entity/smi-type/index']],
                ['label' => 'Smi Kind', 'url' => ['/entity/smi-kind/index']],
                ['label' => 'Smi reason to open', 'url' => ['/entity/smi-reason/index']],
                ['label' => 'Smi distribution type', 'url' => ['/entity/smi-distribution-type/index']],
                ['label' => 'Regions', 'url' => ['/entity/regions/index']],
            ]
        ];
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
