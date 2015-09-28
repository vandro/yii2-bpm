<?php
/**
 * Created by PhpStorm.
 * User: a_niyazov
 * Date: 07.09.2015
 * Time: 10:40
 */
namespace common\modules\entity\common\factories;

use common\helpers\DebugHelper;
use common\modules\entity\common\components\Form;
use yii\base\Component;

class FormFactory extends Component
{
    protected $_form = null;
    protected $_entity = null;
    protected $_action = null;

    public function get($entity, $action)
    {
        $this->form = $action->form;
        $this->action = $action;
        $this->entity = $entity;

        //$this->setHtml();

        return $this;
    }

    protected function setHtml()
    {
        $html = $this->form->html;

        foreach($this->form->fields as $field){
            $html = str_replace('<%'.$field->code.'%>', $field->getWidget($this->entity), $html);
        }

        $this->form->html = $html;
    }

    /**
     * @return null
     */
    public function getForm()
    {
        return $this->_form;
    }

    /**
     * @param null $form
     */
    public function setForm($form)
    {
        $this->_form = $form;
    }

    /**
     * @return null
     */
    public function getEntity()
    {
        return $this->_entity;
    }

    /**
     * @param null $entity
     */
    public function setEntity($entity)
    {
        $this->_entity = $entity;
    }

    /**
     * @return null
     */
    public function getAction()
    {
        return $this->_action;
    }

    /**
     * @param null $action
     */
    public function setAction($action)
    {
        $this->_action = $action;
    }
}