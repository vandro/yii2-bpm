<?php
/**
 * Created by PhpStorm.
 * User: a_niyazov
 * Date: 01.09.2015
 * Time: 16:22
 */
namespace common\modules\entity\common\actions;

use common\helpers\DebugHelper;
use common\modules\entity\common\config\Config;
use common\modules\entity\common\models\EntityForms;
use Yii;
use common\modules\entity\common\models\smi\SmiReestr;
use common\modules\entity\common\factories\EntityTypeFormClassFactory;

class CreateChildEntityElementLinkAction extends \yii\base\Action
{
    public $params;
    public $task_id;
    public $action_id;
    public $prevision_node_id;
    public $redirect_url;
    public $form_id;
    public $parent_id;
    public $link_id;

    public function run()
    {
        $form = EntityForms::findOne($this->form_id);
        $model = EntityTypeFormClassFactory::get($form->id);

        $parentField = $form->getSetting('parent-field');
        $linkField = $form->getSetting('link-field');
        $model->{$parentField} = $this->parent_id;
        $model->{$linkField} = $this->link_id;

        $model->save();

        return $this->controller->redirect([$this->redirect_url,
            'id' =>$this->action_id,
            'task_id' => $this->task_id,
            'prevision_node_id' => $this->prevision_node_id,
        ]);

    }
}