<?php
/**
 * Created by PhpStorm.
 * User: a_niyazov
 * Date: 22.10.2015
 * Time: 11:25
 */
namespace common\modules\entity\common\helpers;

use common\helpers\DebugHelper;
use common\modules\entity\common\models\NodesActions;
use common\modules\entity\common\models\TasksCart;
use Yii;
use common\modules\entity\common\models\permission\User;

class SystemFieldsHelper
{
    const SYSTEM_USER_NAME = 'system_user_name';
    const SYSTEM_DATE = 'system_date';
    const SYSTEM_TASK_ID = 'system_task_id';
    const SYSTEM_NEXT_NODE_ID = 'system_next_node_id';

    protected static $arSystemFields = [
        self::SYSTEM_USER_NAME,
        self::SYSTEM_DATE,
        self::SYSTEM_TASK_ID,
        self::SYSTEM_NEXT_NODE_ID,
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

                    if($field == self::SYSTEM_TASK_ID) {
                        $model->{self::SYSTEM_TASK_ID} = static::getSystemTaskId();
                    }

                    //if($field == self::SYSTEM_NEXT_NODE_ID) {
                        $model->{self::SYSTEM_NEXT_NODE_ID} = static::getSystemNextNodeId();
                    //}
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

    protected function getSystemTaskId()
    {

        return Yii::$app->request->get('task_id');
    }

    protected function getSystemNextNodeId()
    {
        $action = NodesActions::findOne(Yii::$app->request->get('id'));
        $task = TasksCart::findOne(Yii::$app->request->get('task_id'));
        return $action->getNarLink($task->current_node_id)->next_node_id;
    }


}