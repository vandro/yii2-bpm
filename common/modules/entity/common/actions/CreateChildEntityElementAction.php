<?php
/**
 * Created by PhpStorm.
 * User: a_niyazov
 * Date: 01.09.2015
 * Time: 16:22
 */
namespace common\modules\entity\common\actions;

use common\modules\entity\common\config\Config;
use common\modules\entity\common\models\EntityForms;
use Yii;
use common\modules\entity\common\models\smi\SmiReestr;

class CreateChildEntityElementAction extends \yii\base\Action
{
    public $params;
    public $task_id;
    public $action_id;
    public $prevision_node_id;
    public $redirect_url;
    public $form_id;

    public function run()
    {
//        $model = new SmiReestr();
        $form = EntityForms::findOne($this->form_id);
        $model = Yii::$app->modules[Config::MODULE_NAME]->entityFactory->getByForm($form);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->controller->redirect([$this->redirect_url,
                'id' =>$this->action_id,
                'task_id' => $this->task_id,
                'prevision_node_id' => $this->prevision_node_id,
            ]);
        } else {
            return $this->controller->redirect([$this->redirect_url,
                'id' =>$this->action_id,
                'task_id' => $this->task_id,
                'prevision_node_id' => $this->prevision_node_id,
            ]);
        }
    }
}