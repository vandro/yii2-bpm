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

    public static function getDependFromData($field, $entity, $entityType)
    {
        $options = json_decode($field->options, true);
        $entityModel = $entityType->getItemSearchModelForFrontend();
        $dependFrom = $options['dependFrom'];
        $values = $entityModel::find()->where([$dependFrom => $entity->{$dependFrom}])->all();

        $entityClassName = (new \ReflectionClass($entity))->getShortName();
        $fieldDomId = strtolower($entityClassName.'-'.$field->code);

        Yii::$app->controller->view->registerJs("
            $('#".strtolower($entityClassName.'-'.$dependFrom)."').change(function(){
                $.ajax({
                    type: 'post',
                    dataType: 'json',
                    url: '".Yii::$app->urlManager->createUrl('bpm/actions-cart/items')."?parent_id='+$('#".strtolower($entityClassName.'-'.$dependFrom)."').val()+'&entity_type_id=".$entityType->id."&key_field=".$options['key']."&value_field=".$options['value']."&filter_field=".$dependFrom."',
                    success: function (result) {
                        $('#".$fieldDomId." option').remove();
                        $('#".$fieldDomId."').append('<option value=\"0\">-- Выберите --</option>');
                        for (key in result) {
                            $('#".$fieldDomId."').append('<option value=\"' + result[key].value + '\">' + result[key].label + '</option>');
                        }
                    }
                });
            });
        ");

        return $values;
    }
}