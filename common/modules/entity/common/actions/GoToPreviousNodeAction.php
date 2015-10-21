<?php
/**
 * Created by PhpStorm.
 * User: a_niyazov
 * Date: 01.09.2015
 * Time: 16:22
 */
namespace common\modules\entity\common\actions;

use common\modules\entity\common\models\TasksCart;
use Yii;
use yii\web\NotFoundHttpException;


class GoToPreviousNodeAction extends \yii\base\Action
{
    public $task_id;
    public $previous_node_id;

    public function run()
    {
        if (($model = TasksCart::findOne($this->task_id)) !== null) {

            $model->current_node_id = $this->previous_node_id;
            $model->save();

            return $this->controller->redirect(['nodes-cart/view',
                'id' => $model->current_node_id,
                'task_id' => $model->id,
            ]);
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}