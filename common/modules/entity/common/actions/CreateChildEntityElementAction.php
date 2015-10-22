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
use common\modules\entity\common\factories\EntityTypeFormClassFactory;
use common\modules\entity\common\helpers\SystemFieldsHelper;

class CreateChildEntityElementAction extends \common\modules\entity\common\actions\EntityFormAction
{
    public $params;
    public $task_id;
    public $action_id;
    public $prevision_node_id;
    public $redirect_url;
    public $form_id;
    public $go_to_next_node;

    public function run()
    {
        $form = EntityForms::findOne($this->form_id);
        $model = EntityTypeFormClassFactory::get($form->id);

        $model->load(Yii::$app->request->post());
        $model = SystemFieldsHelper::setSystemFieldsValue($model, $form);
        $model->save();

        if($this->go_to_next_node) {
            $action = $this->findModel($this->action_id);
            $task = $this->findTaskModel($this->task_id);
            $entity = $task->getEntityByForm($action->form_id);
            $this->goToNextNode($task, $action, $entity);
        }else{
            return $this->controller->redirect([$this->redirect_url,
                'id' => $this->action_id,
                'task_id' => $this->task_id,
                'prevision_node_id' => $this->prevision_node_id,
            ]);
        }

    }
}