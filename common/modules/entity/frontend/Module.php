<?php

namespace common\modules\entity\frontend;

use Yii;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'common\modules\entity\frontend\controllers';

    public function init()
    {
        parent::init();

        Yii::configure($this, [
            'components' => [
                'entityFactory' => [
                    'class' => 'common\modules\entity\common\factories\EntityFactory'
                ],
                'formFactory' => [
                    'class' => 'common\modules\entity\common\factories\FormFactory'
                ],
                'widgetFactory' => [
                    'class' => 'common\modules\entity\common\factories\WidgetFactory'
                ],
            ]
        ]);
    }
}
