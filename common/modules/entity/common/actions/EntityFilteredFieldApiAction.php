<?php
/**
 * Created by PhpStorm.
 * User: a_niyazov
 * Date: 01.09.2015
 * Time: 16:22
 */
namespace common\modules\entity\common\actions;

use common\helpers\DebugHelper;
use common\modules\entity\common\models\EntityTypes;
use Yii;

class EntityFilteredFieldApiAction extends \yii\base\Action
{
    public $parent_id;
    public $entity_type_id;
    public $key_field;
    public $value_field;
    public $filter_field;

    public function run()
    {
        $entityType = EntityTypes::findOne($this->entity_type_id);
        $entityModel = $entityType->getItemSearchModelForFrontend();
        $arItems = [];
        $items = $entityModel::find()->where([$this->filter_field => $this->parent_id])->all();
        foreach($items as $item){
            $arItems[] = ['value' => $item->{$this->key_field}, 'label' => $item->{$this->value_field}];
        }
        echo json_encode($arItems);
    }
}