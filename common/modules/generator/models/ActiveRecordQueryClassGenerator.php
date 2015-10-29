<?php
/**
 * Author: Avazbek Niyazov
 * Email: avazbe@gmail.com
 * Date: 23.09.2015
 * Time: 12:03
 */
namespace common\modules\generator\models;

use common\helpers\DebugHelper;
use common\modules\generator\models\AbstractClassGenerator;
use Yii;

class ActiveRecordQueryClassGenerator extends AbstractClassGenerator
{

    const RENDER_MODE_VALUE = 'ACTIVE_RECORD_QUERY_MODE';

    public function __construct($params)
    {
        $arParams = $params;
        $arParams[self::USED_CLASSES] = [
            'Yii',
            'yii\\db\\ActiveQuery',
        ];
        $arParams[self::EXTEND_CLASS_NAME] = 'ActiveQuery';
        $arParams[self::CLASS_NAME] = $params[self::CLASS_NAME]."Query";
        parent::__construct($arParams);
    }


    protected function addBeforeClassBegin()
    {
        $this->classString .= "/**\n";
        $this->classString .= " * This is the ActiveQuery class for [[".$this->params[self::CLASS_NAME]."]].\n";
        $this->classString .= " */\n";
    }

    protected function addInClass()
    {
        $this->addAllAndOne();
        $this->addPropertyMethods();
        $this->addRelationMethods();
    }


    /**
     * @inheritdoc
     * @return SmiReestr[]|array
     *
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return SmiReestr|array|null
     *
    public function one($db = null)
    {
        return parent::one($db);
    }*/

    protected function addAllAndOne()
    {
        $this->classString .= "    /**\n";
        $this->classString .= "     * @inheritdoc\n";
        $this->classString .= "     * @return ".$this->params[self::CLASS_NAME]."[]|array\n";
        $this->classString .= "     */\n";
        $this->classString .= "    public function all(\$db = null)\n";
        $this->classString .= "    {\n";
        $this->classString .= "         return parent::all(\$db);\n";
        $this->classString .= "    }\n\n";

        $this->classString .= "    /**\n";
        $this->classString .= "     * @inheritdoc\n";
        $this->classString .= "     * @return ".$this->params[self::CLASS_NAME]."[]|array|null\n";
        $this->classString .= "     */\n";
        $this->classString .= "    public function one(\$db = null)\n";
        $this->classString .= "    {\n";
        $this->classString .= "         return parent::one(\$db);\n";
        $this->classString .= "    }\n\n";
    }

    /*
    public function type($type)
    {
        $this->andWhere(['type_id' => $type->id]);
        return $this;
    }

    public function type_id($type_id)
    {
        $this->andWhere(['type_id' => $type_id]);
        return $this;
    }*/

    protected function addPropertyMethods()
    {
        $arControlDuplicates = [];
        if (isset($this->params[self::PROPERTIES])) {
            foreach ($this->params[self::PROPERTIES] as $property) {
                if(!in_array($property[self::PROPERTY_NAME], $arControlDuplicates)) {
                    $this->classString .= "    /**\n";
                    $this->classString .= "     * @return \\yii\\db\\ActiveQuery.\n";
                    $this->classString .= "     */\n";
                    $this->classString .= "    public function " . $property[self::PROPERTY_NAME] . "($" . $property[self::PROPERTY_NAME] . ")\n";
                    $this->classString .= "    {\n";
                    if ($property[self::PROPERTY_TYPE] == 'string') {
                        $this->classString .= "         \$this->andWhere(['like','" . $property[self::PROPERTY_NAME] . "', $" . $property[self::PROPERTY_NAME] . "]);\n";
                    } else {
                        $this->classString .= "         \$this->andWhere(['" . $property[self::PROPERTY_NAME] . "' => $" . $property[self::PROPERTY_NAME] . "]);\n";
                    }
                    $this->classString .= "         return \$this;\n";
                    $this->classString .= "    }\n\n";

                    $arControlDuplicates[] = $property[self::PROPERTY_NAME];
                }
            }
        }
    }

    /*
    public function specialization($specialization)
    {
        $this->joinWith('smiSpecialization')
            ->andWhere(['`smi_specialization`.`id`' => $specialization->id]);
        return $this;
    }*/

    protected function addRelationMethods()
    {
        if(isset($this->params[self::RELATIONS]) && !empty($this->params[self::RELATIONS])) {
            foreach ($this->params[self::RELATIONS] as $relation) {
                $this->classString .= "    /**\n";
                $this->classString .= "     * @return \\yii\\db\\ActiveQuery.\n";
                $this->classString .= "     */\n";
                $this->classString .= "    public function " . $relation[self::RELATION_METHOD_NAME] . "Relation($" . $relation[self::RELATION_METHOD_NAME] . ")\n";
                $this->classString .= "    {\n";
                $this->classString .= "         \$this->joinWith('" . $relation[self::RELATION_METHOD_NAME] . "')\n";
                $this->classString .= "             ->andWhere(['`" . $relation[self::RELATION_TABLE_NAME] . "`.`id`' => $" . $relation[self::RELATION_METHOD_NAME] . "->id]);\n";
                $this->classString .= "         return \$this;\n";
                $this->classString .= "    }\n\n";
            }
        }
    }
}