<?php
/**
 * Created by PhpStorm.
 * User: a_niyazov
 * Date: 07.09.2015
 * Time: 13:30
 */
namespace common\modules\entity\common\factories;

use yii\base\Component;

class WidgetFactory extends Component
{
    protected $_entity = null;
    protected $_field = null;
    protected $_form = null;



    public function get($field, $entity, $form)
    {
        $this->field = $field;
        $this->entity = $entity;
        $this->form = $form;

        return $this->getHtml();
    }

    protected function getHtml()
    {
        if($this->field->type == 'VARCHAR' || $this->field->type == 'INT'){
            return $this->form->field($this->entity, $this->field->code)->textInput();
        }elseif($this->field->type == 'TEXT'){
            return $this->form->field($this->entity, $this->field->code)->textArea();
        }
    }

    /**
     * @return null
     */
    public function getField()
    {
        return $this->_field;
    }

    /**
     * @param null $field
     */
    public function setField($field)
    {
        $this->_field = $field;
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
}