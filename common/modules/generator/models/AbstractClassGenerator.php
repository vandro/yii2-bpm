<?php
/**
 * Author: Avazbek Niyazov
 * Email: avazbe@gmail.com
 * Date: 16.10.2015
 * Time: 18:45
 */
namespace common\modules\generator\models;

abstract class AbstractClassGenerator
{
    const NAME_SPACE = 'NAME_SPACE';
    const CLASS_NAME = 'CLASS_NAME';
    const EXTEND_CLASS_NAME = 'EXTEND_CLASS_NAME';
    const USED_CLASSES =  'USED_CLASSES';
    const DATABASE_NAME = 'DATABASE_NAME';
    const TABLE_NAME = 'TABLE_NAME';
    const PROPERTIES = 'PROPERTIES';
    const PROPERTY_NAME = 'PROPERTY_NAME';
    const PROPERTY_TYPE = 'PROPERTY_TYPE';
    const PROPERTY_VALIDATION_RULES = 'PROPERTY_VALIDATION_RULES';
    const PROPERTY_VALIDATION_RULE_TYPE = 'PROPERTY_VALIDATION_RULE_TYPE';
    const AUTHOR_NAME = 'AUTHOR_NAME';
    const PROPERTY_LABEL = 'PROPERTY_LABEL';
    const I18N_MESSAGE_FILE_ALIAS = 'I18N_MESSAGE_FILE_ALIAS';
    const ACTIVE_QUERY_CLASS_NAME = 'ACTIVE_QUERY_CLASS_NAME';
    const CLASS_FILE_LOCATION_PATH = 'CLASS_FILE_LOCATION_PATH';
    const PROPERTIES_VALIDATION_RULES = 'PROPERTIES_VALIDATION_RULES';
    const RELATIONS = 'RELATIONS';
    const RELATION = 'RELATION';
    const RELATION_METHOD_NAME = 'RELATION_METHOD_NAME';
    const RELATION_TYPE = 'RELATION_TYPE';
    const RELATION_TYPE_HAS_MANY = 'hasMany';
    const RELATION_TYPE_HAS_ONE = 'hasOne';
    const RELATION_FOREIGN_KEY = 'RELATION_FOREIGN_KEY';
    const RELATION_TARGET_KEY = 'RELATION_TARGET_KEY';
    const RELATION_TARGET_CLASS = 'RELATION_TARGET_CLASS';
    const RELATION_TABLE_NAME = 'RELATION_TABLE_NAME';
    const RENDER_MODE = 'RENDER_MODE';
    const RENDER_MODE_VALUE = 'RENDER_MODE_VALUE'; // Эту константу необходимо переопределить в дочернем классе

    protected $params;
    protected $classString;

    public function __construct($params)
    {
        $params[static::RENDER_MODE] = static::RENDER_MODE_VALUE;
        $this->params = $params;
        $this->classString = '';
        $this->render();
    }


    public function getClassString()
    {
        return $this->classString;
    }

    public function generateClassFile()
    {
        return $this->makeClassFile();
    }

    protected function render()
    {
        $this->addHeader();
        $this->addNamespace();
        $this->addUses();
        $this->addBeforeClassBegin();
        $this->addClassBegin();
        $this->addInClass();
        $this->addClassEnd();
    }



    protected function addHeader()
    {
        $this->classString .= "<?php\n";
        $this->classString .= "/**\n";
        $this->classString .= "* Created by ".get_class($this).".\n";
        if(isset($this->params[self::AUTHOR_NAME])) {
            $this->classString .= "* Author: " . $this->params[self::AUTHOR_NAME] . "\n";
        }
        $this->classString .= "* Date: ".date("d.m.Y")."\n";
        $this->classString .= "* Time: ".date("h:i:sa")."\n";
        $this->classString .= "*/\n\n";
    }

    protected function addNamespace()
    {
        if(isset($this->params[self::NAME_SPACE])) {
            $this->classString .= "namespace " . $this->params[self::NAME_SPACE] . ";\n\n";
        }
    }

    protected function addUses()
    {
        if(isset($this->params[self::USED_CLASSES])) {
            foreach ($this->params[self::USED_CLASSES] as $use) {
                $this->classString .= "use " . $use . ";\n";
            }
        }
        $this->classString .= "\n";
    }

    abstract protected function addBeforeClassBegin(); // В этом методе необходимо вызвать методы которые будут добавлять определения перед генерируемым классом

    protected function addClassBegin()
    {
        if(isset($this->params[self::CLASS_NAME])){
            $this->classString .= "class ".$this->params[self::CLASS_NAME];
        }
        if(isset($this->params[self::EXTEND_CLASS_NAME])) {
            $this->classString .= " extends " . $this->params[self::EXTEND_CLASS_NAME];
        }
        $this->classString .= "\n{\n";
    }

    abstract protected function addInClass(); // В этом методе необходимо вызвать методы которые будут добавлять содержимое генерируемого класса

    protected function addClassEnd()
    {
        $this->classString .= "}";
    }

    protected function getName($nameString)
    {
        $name = '';
        $arName = explode("_",$nameString);
        foreach($arName as $nameItem){
            $name .= ucfirst($nameItem);
        }

        return $name;
    }

    protected function getMethodsName($nameString)
    {
        $replaceItems = ['id', 'Id', 'ID', '_id', '_Id', '_ID', '_id_', '_Id_', '_ID_',];

        foreach($replaceItems as $item) {
            $nameString = str_replace($item, '', $nameString);
        }

        $name = self::getName($nameString);

        return $name;
    }

    protected function makeClassFile()
    {
        $locationPath = $this->params[self::CLASS_FILE_LOCATION_PATH];
        if(!is_dir($locationPath)){
            mkdir($locationPath);
        }
        $result = file_put_contents($locationPath.DIRECTORY_SEPARATOR.$this->params[self::CLASS_NAME].".php",$this->classString);
        if(!empty($result)){
            return true;
        }

        return false;
    }
}