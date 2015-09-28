<?php
/**
* Created by BehaviorClassFactory.
* User: avazbe
* Date: 23.09.2015
* Time: 11:34:54am
*/

namespace common\modules\entity\common\behaviors;

use yii\base\Behavior;

class RequestBehavior extends Behavior
{
    public $_title_string;

    public $_code_string;

    public $_balans_string;

    public function getTitleString()
    {
         return $this->_title_string;
    }

    public function setTitleString($value)
    {
         $this->_title_string = $value;
    }

    public function getCodeString()
    {
         return $this->_code_string;
    }

    public function setCodeString($value)
    {
         $this->_code_string = $value;
    }

    public function getBalansString()
    {
         return $this->_balans_string;
    }

    public function setBalansString($value)
    {
         $this->_balans_string = $value;
    }

    public function joinRequest($query)
    {
         $query->joinWith('Request');
    }

}