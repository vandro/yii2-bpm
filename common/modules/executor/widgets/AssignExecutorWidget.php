<?php
/**
 * Created by PhpStorm.
 * User: a_niyazov
 * Date: 04.10.2015
 * Time: 11:38
 */
namespace common\modules\executor\widgets;

use common\helpers\DebugHelper;
use common\modules\executor\models\User;
use Yii;

class AssignExecutorWidget extends \yii\bootstrap\Widget
{
    public $executor_id = null;
    public $task_id = null;

    public function run(){

        $chief = User::findOne(Yii::$app->user->id);

        if($chief->hasOrganisationRight()) {
            $executors = User::find()
                ->where([
                    'organisation_id' => $chief->organisation_id,
                ])
                ->all();
        }else{
            $executors = User::find()
                ->where([
                    'department_id' => $chief->department_id,
                ])
                ->all();
        }

        return $this->render('assignExecutorWidgetView',[
            'executors' => $executors,
            'task_id' => $this->task_id,
        ]);
    }

}