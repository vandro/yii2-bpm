<?php
/**
 * Created by PhpStorm.
 * User: a_niyazov
 * Date: 04.10.2015
 * Time: 11:38
 */
namespace common\modules\log\widgets;

use common\modules\log\models\TaskLog;
use Yii;
use yii\data\ActiveDataProvider;

class LogWidget extends \yii\bootstrap\Widget
{
    public $task_id = null;

    public function run(){

        $logs = TaskLog::find()
            ->where([
                'task_id' => $this->task_id,
            ]);

        $logsAdp =  new ActiveDataProvider([
            'query' => $logs,
        ]);

        return $this->render('logWidgetView',[
            'logsAdp' => $logsAdp,
        ]);
    }

}