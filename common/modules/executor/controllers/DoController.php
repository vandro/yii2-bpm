<?php

namespace common\modules\executor\controllers;

use common\modules\entity\common\models\TasksCart;
use yii\web\Controller;

class DoController extends Controller
{
    public function actionAssign($task_id, $executor_id)
    {
        $task = TasksCart::findOne($task_id);
        $task->assigned_to_id = $executor_id;
        if($task->save()){
            return json_encode(['status' => 1]);
        }else{
            return json_encode(['status' => 0]);
        }
    }
}
