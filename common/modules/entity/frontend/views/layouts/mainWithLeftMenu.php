<?php
use yii\bootstrap\ButtonGroup;
?>

<?php $this->beginContent('//layouts/main'); ?>
    <?=ButtonGroup::widget([
        'buttons' => [
            ['label' => 'Adsfdfadsfd'],
            ['label' => 'Badsfadsfadsf'],
            ['label' => 'Cdfadsfadsf', 'visible' => false],
        ]
    ]);?>
        <?= $content ?>
<?php $this->endContent(); ?>
