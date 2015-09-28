<?php
/**
 * Created by PhpStorm.
 * User: a_niyazov
 * Date: 15.09.2015
 * Time: 13:36
 */
namespace common\modules\entity\common\components;


use common\modules\entity\common\models\Roles;
use common\modules\entity\common\models\TasksCart;
use frontend\components\DebugHelper;

class TaskAccessRule extends \yii\filters\AccessRule {

    public $request;
    /**
     * @inheritdoc
     */
    protected function matchRole($user)
    {
        $task = TasksCart::findOne($this->request->get('id'));

        foreach($task->currentNode->viewRoleLinks as $roleLink){
            if($roleLink->role_id == $user->role){
                return true;
            }
        }

        return false;
    }
}