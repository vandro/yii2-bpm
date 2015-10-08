<?php
/**
 * Created by PhpStorm.
 * User: a_niyazov
 * Date: 01.09.2015
 * Time: 16:22
 */
namespace common\modules\entity\common\actions;

use Yii;

class FilteredFieldApiAction extends \yii\base\Action
{
    public $parent_id;
    public $object_class;
    public $key_field;
    public $value_field;
    public $filter_field;

    public function run()
    {
        $arItems = [];
        $objectClass = $this->object_class;
        $items = $objectClass::find()->where([$this->filter_field => $this->parent_id])->all();
        foreach($items as $item){
            $arItems[] = ['value' => $item->{$this->key_field}, 'label' => $item->{$this->value_field}];
        }
        echo json_encode($arItems);
    }
}