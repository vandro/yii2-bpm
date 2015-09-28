<?php
/**
 * Created by PhpStorm.
 * User: a_niyazov
 * Date: 04.03.2015
 * Time: 13:02
 */
namespace common\modules\entity\common\factories;

use common\helpers\DebugHelper;
use common\modules\entity\common\components\EntityContainer;
use yii\db\Schema;

class EntityContainerFactory
{
    public static function getInstance($entity)
    {
        $container = new EntityContainer;

        $container->setEntity($entity);

        $container->setColumns(self::getColumns($entity));

        return $container;
    }

    protected static function getColumns($entity)
    {
        $columns = [];

        foreach($entity->fields as $nextField){

            $definition = $nextField->type;


            if($nextField->type != 'TEXT' && $nextField->type != 'DATE') {
                $definition .= '('.$nextField->length.')';
            }

            $columns[$nextField->code] = $definition;
        }

        return $columns;
    }
}