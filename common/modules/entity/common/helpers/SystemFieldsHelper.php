<?php
/**
 * Created by PhpStorm.
 * User: a_niyazov
 * Date: 22.10.2015
 * Time: 11:25
 */
namespace common\modules\entity\common\helpers;

use common\helpers\DebugHelper;
use Yii;
use common\modules\entity\common\models\permission\User;

class SystemFieldsHelper
{
    const SYSTEM_USER_NAME = 'system_user_name';
    const SYSTEM_DATE = 'system_date';

    protected static $arSystemFields = [
        self::SYSTEM_USER_NAME,
        self::SYSTEM_DATE,
    ];

    public static function setSystemFieldsValue($model, $form)
    {
        $formFields = $form->fields;
        foreach(static::$arSystemFields as $field) {
            foreach($formFields as $formField) {
                if ($formField->code == $field) {

                    if($field == self::SYSTEM_USER_NAME) {
                        $model->{self::SYSTEM_USER_NAME} = static::getSystemCurrentUserName();
                    }

                    if($field == self::SYSTEM_DATE) {
                        $model->{self::SYSTEM_DATE} = static::getSystemDate();
                    }
                }
            }
        }

        return $model;
    }

    public static function isSystemField($fieldName)
    {
        foreach(static::$arSystemFields as $field) {
            if($fieldName == $field){
                return true;
            }
        }

        return false;
    }

    protected function getSystemCurrentUserName()
    {
        $user = User::findOne(Yii::$app->user->id);
        return !empty($user)?$user->username:'';
    }

    protected function getSystemDate()
    {

        return date('Y-m-d h:i:sa');
    }


}