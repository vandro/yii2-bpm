<?php

namespace common\modules\entity\backend;

use Yii;
class Module extends \yii\base\Module
{
    public $controllerNamespace = 'common\modules\entity\backend\controllers';

    public function init()
    {
        parent::init();

        Yii::configure($this, [
            'components' => [
                'factory' => [
                    'class' => 'common\modules\entity\common\factories\Factory'
                ]
            ]
        ]);
    }
}
