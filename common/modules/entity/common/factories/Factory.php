<?php
/**
 * Created by PhpStorm.
 * User: a_niyazov
 * Date: 05.09.2015
 * Time: 18:56
 */
namespace common\modules\entity\common\factories;

use Yii;
use yii\base\Component;

class Factory extends Component
{
    public static $type = null;

    public static function get()
    {
        return Yii::$app->{self::$type};
    }

    public function getLabel()
    {
        return 'Factory label';
    }
}