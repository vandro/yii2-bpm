<?php
/**
 * Created by PhpStorm.
 * User: a_niyazov
 * Date: 07.09.2015
 * Time: 13:30
 */
namespace common\modules\entity\common\factories;

use common\helpers\DebugHelper;
use common\modules\entity\common\models\EntityTypes;
use common\modules\entity\common\models\TasksCart;
use yii\base\Component;

class WidgetFactory extends Component
{
    protected $_entity = null;
    protected $_field = null;
    protected $_activeForm = null;
    protected $_form = null;

    public function get($field, $entity, $activeForm, $form)
    {
        $this->field = $field;
        $this->entity = $entity;
        $this->activeForm = $activeForm;
        $this->form = $form;

        return $this->getHtml();
    }

    protected function getHtml()
    {
        $entity = $this->entity;
        if($this->field->type == 'VARCHAR' || $this->field->type == 'INT'){
            if(empty($this->field->dictionary)) {
                return $this->activeForm->field($this->entity, $this->field->code)->textInput();
            }else{
                if($this->form->mode == 'create') {
                    $entity->{$this->field->code} = '';
                }
                $dictionary = $this->field->dictionary;
                return $this->activeForm->field($entity, $this->field->code)->dropDownList($dictionary->getSelectData($this->field),[
                    'prompt' => ' -- Выберите --'
                ]);
            }
        }elseif($this->field->type == 'TEXT'){
            return $this->activeForm->field($this->entity, $this->field->code)->textArea();
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
    public function getActiveForm()
    {
        return $this->_activeForm;
    }

    /**
     * @param null $activeForm
     */
    public function setActiveForm($activeForm)
    {
        $this->_activeForm = $activeForm;
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