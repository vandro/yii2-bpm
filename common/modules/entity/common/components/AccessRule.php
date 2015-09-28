<?php
/**
 * Created by PhpStorm.
 * User: a_niyazov
 * Date: 15.09.2015
 * Time: 13:36
 */
namespace common\modules\entity\common\components;


use frontend\components\DebugHelper;

class AccessRule extends \yii\filters\AccessRule {

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

//        if (empty($this->roles)) {
//            return true;
//        }
//        foreach ($this->roles as $role) {
//            if ($role === '?') {
//                if ($user->getIsGuest()) {
//                    return true;
//                }
//            } elseif ($role === '@') {
//                if (!$user->getIsGuest()) {
//                    return true;
//                }
//                // Check if the user is logged in, and the roles match
//            } elseif (!$user->getIsGuest() && $role === $user->identity->role) {
//                return true;
//            }
//        }
//
//        return false;
    }
}