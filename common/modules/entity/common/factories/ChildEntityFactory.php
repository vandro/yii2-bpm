<?php
/**
 * Created by PhpStorm.
 * User: a_niyazov
 * Date: 03.03.2015
 * Time: 12:16
 */
namespace common\modules\entity\common\factories;

//use backend\models\Entity;
use backend\models\EntityItemModel;
use common\helpers\DebugHelper;
use common\modules\entity\common\components\ChildEntity;
use common\modules\entity\common\models\EntityTypes;
use common\modules\entity\common\components\Entity;
use common\modules\entity\common\models\NodesActions;
use common\modules\entity\common\models\Tasks;
use common\modules\entity\common\models\TasksCart;
use common\modules\entity\common\models\TasksEntitiesLink;
use yii\base\Component;
use yii\web\NotFoundHttpException;

class ChildEntityFactory extends Component
{
    protected static $model = null;
    protected static $childModel = null;
    protected static $configs = [];

    protected static $rules = [];
    protected static $searchRules = [];
    protected static $searchParams = [];
    protected static $labels = [];
    protected static $entityType;
    protected static $entityTypes = [];
    protected static $action = null;
    protected static $actions = [];
    protected static $task = null;
    protected static $tasks = [];

    protected static $form = null;
    protected static $view = null;

    public static function get($action, $task)
    {

        self::$form = $action->form;
        $entityType = self::getEntityType($action->form->entity_id);
        $model = self::getModel();
        $model->modelInit(self::getConfig($entityType));
        $model->setEntityType($entityType);

        if($action->form->mode == 'update' || $action->form->mode == 'view') {
            $entityItemLink = TasksEntitiesLink::find()->where(['task_id' => $task->id, 'entity_id' => $action->form->entity_id])->one();
            if (($itemModel = $model::findOne($entityItemLink->entity_item_id)) !== null) {
                return $itemModel;
            } else {
                throw new NotFoundHttpException('The requested entity item does not exist.');
            }
        }

        return $model;
    }


    public static function getChildByForm($form)
    {

        self::$form = $form;
        $entityType = self::getEntityType($form->entity_id);
        $model = new ChildEntity(); //self::getChildModel();
        $model->modelInit(self::getConfig($entityType));
//        $model->modelInit(self::getConfigNoCache($entityType));
        $model->setEntityType($entityType);

        return $model;
    }

    protected static function getChildModel()
    {
        if(empty(self::$childModel)){
            self::$childModel = new ChildEntity();
        }
        return self::$childModel;
    }

    public static function getByForm($form)
    {
        self::$form = $form;
        $entityType = self::getEntityType($form->entity_id);
        $model = self::getModel();
        $model->modelInit(self::getConfig($entityType));
        $model->setEntityType($entityType);

        return $model;
    }

    public static function getFullEntityModelByTaskId($entity_id, $taskId)
    {
        $entityType = self::getEntityType($entity_id);
        $model = self::getModel();
        $model->modelInit(self::getFullConfig($entityType));
        $model->setEntityType($entityType);

        $entityItemLink = TasksEntitiesLink::find()->where(['task_id' => $taskId, 'entity_id' => $entity_id])->one();

        if (($itemModel = $model::findOne($entityItemLink->entity_item_id)) !== null) {
            return $itemModel;
        } else {
            throw new NotFoundHttpException('The requested entity item does not exist.');
        }


        return $model;
    }

    public static function getFullEntityModel($entity_id, $item_id)
    {
        $entityType = self::getEntityType($entity_id);
        $model = self::getModel();
        $model->modelInit(self::getFullConfig($entityType));
        $model->setEntityType($entityType);

        if (($itemModel = $model::findOne($item_id)) !== null) {
            return $itemModel;
        } else {
            throw new NotFoundHttpException('The requested entity item does not exist.');
        }


        return $model;
    }

    public static function getInstance($entityType = null)
    {
        self::$entityTypes[$entityType->id] = $entityType;
        $model = self::getModel();
        $model->modelInit(self::getFullConfig($entityType));
        $model->setEntityType($entityType);

        return $model;
    }

//    public static function getInstance($entityType)
//    {
//        self::$entityTypes[$entityType->id] = $entityType;
//        $model = self::getModel();
//        $model->modelInit(self::getConfig($entityType));
//        $model->setEntityType($entityType);
//
//        return $model;
//    }

    public static function getInstanceById($id)
    {
        $entityType = self::getEntityType($id);
        $model = self::getModel();
        $model->modelInit(self::getFullConfig($entityType));
        $model->setEntityType($entityType);

        return $model;
    }

    public static function getInstanceByCode($code)
    {

        $entityType = self::getEntityType(EntityTypes::find()->where(['code' => $code])->one()->id);
        $model = self::getModel();
        $model->modelInit(self::getConfig($entityType));
        $model->setEntity($entityType);

        return $model;
    }

    public static function getInstanceModel($model_id, $entityType_id)
    {
        $entityType = self::getEntityType($entityType_id);
        $model = self::getModel();
        $model->modelInit(self::getConfig($entityType));
        $model->setEntity($entityType);

        if (($itemModel = $model::findOne($model_id)) !== null) {
            return $itemModel;
        } else {
            throw new NotFoundHttpException('The requested entity item does not exist.');
        }
    }

    public static function getInstanceModelByView($model_id, $entityType_id, $view)
    {
        self::$form = $view;
        $entityType = self::getEntityType($entityType_id);
        $model = self::getModel();
        $model->modelInit(self::getConfig($entityType));
        $model->setEntityType($entityType);

        if (($itemModel = $model::findOne($model_id)) !== null) {
            return $itemModel;
        } else {
            throw new NotFoundHttpException('The requested entity item does not exist.');
        }
    }

    protected static function getModel()
    {
//        if(empty(self::$model)){
//            self::$model = new Entity();
//        }
//        return self::$model;
        return new Entity();
    }

    public static function getConfig($entityType)
    {
        if(empty(self::$configs[$entityType->code])) {
            self::$entityType = $entityType;
            self::setRules();
            self::setSearchRules();
            self::setSearchParams();
            self::setLabels();

            $config = [
                Entity::TABLE => self::$entityType->code,
                Entity::RULES => self::$rules,
                Entity::LABELS => self::$labels,
                Entity::SEARCH_RULES => self::$searchRules,
                Entity::SEARCH_PARAMS => self::$searchParams,
            ];

            self::$configs[$entityType->code] = $config;
        }

        return  self::$configs[$entityType->code];
    }

    public static function getConfigNoCache($entityType)
    {
        self::$entityType = $entityType;
        self::setRules();
        self::setSearchRules();
        self::setSearchParams();
        self::setLabels();

        $config = [
            Entity::TABLE => self::$entityType->code,
            Entity::RULES => self::$rules,
            Entity::LABELS => self::$labels,
            Entity::SEARCH_RULES => self::$searchRules,
            Entity::SEARCH_PARAMS => self::$searchParams,
        ];

        return  $config;
    }

    public static function getFullConfig($entityType)
    {
        if(empty(self::$configs[$entityType->code])) {
            self::$entityType = $entityType;
            self::setFullRules();
            self::setFullSearchRules();
            self::setFullSearchParams();
            self::setFullLabels();

            $config = [
                Entity::TABLE => self::$entityType->code,
                Entity::RULES => self::$rules,
                Entity::LABELS => self::$labels,
                Entity::SEARCH_RULES => self::$searchRules,
                Entity::SEARCH_PARAMS => self::$searchParams,
            ];

            self::$configs[$entityType->code] = $config;
        }

        return  self::$configs[$entityType->code];
    }

    public static function setRules()
    {
        $rulesTypes = [];
        $rules = [];

        foreach (self::$form->rules as $rule) {
            $rulesTypes[$rule->code][] = $rule->field->code;
        }

        foreach($rulesTypes as $key => $value){
            $rules[] = [$value, $key];
        }

        self::$rules = $rules;
    }

    public static function setFullRules()
    {
        $rulesTypes = [];
        $rules = [];

        foreach (self::$entityType->fields as $field) {
            if($field->type == 'VARCHAR' || $field->type == 'TEXT') {
                $rulesTypes['string'][] = $field->code;
            }elseif($field->type == 'INT'){
                $rulesTypes['integer'][] = $field->code;
            }
        }

        foreach($rulesTypes as $key => $value){
            $rules[] = [$value, $key];
        }

        self::$rules = $rules;
    }

    public static function setSearchRules()
    {
        $rules = [];
        $rulesTypes = [];

        foreach(self::$form->rules as $rule) {
            if($rule->field->type == 'VARCHAR' || $rule->field->type == 'TEXT'){
                $rulesTypes['string'][] = $rule->field->code;
            }elseif($rule->field->type == 'INT') {
                $rulesTypes['integer'][] = $rule->field->code;
            }
        }

        foreach($rulesTypes as $key => $value){
            $rules[] = [$value, $key];
        }

        self::$searchRules = $rules;
    }

    public static function setFullSearchRules()
    {
        $rules = [];
        $rulesTypes = [];

        foreach(self::$entityType->fields as $field) {
            if($field->type == 'VARCHAR' || $field->type == 'TEXT'){
                $rulesTypes['string'][] = $field->code;
            }elseif($field->type == 'INT') {
                $rulesTypes['integer'][] = $field->code;
            }
        }

        foreach($rulesTypes as $key => $value){
            $rules[] = [$value, $key];
        }

        self::$searchRules = $rules;
    }

    public static function setSearchParams()
    {
        self::$searchParams = [];
        foreach(self::$form->rules as $rule) {
            if($rule->field->type == 'VARCHAR' || $rule->field->type == 'TEXT'){
                self::$searchParams[$rule->field->code] = 'like';
            }elseif($rule->field->type == 'INT') {
                self::$searchParams[$rule->field->code] = '=';
            }
        }
    }

    public static function setFullSearchParams()
    {
        self::$searchParams = [];
        foreach(self::$entityType->fields as $field) {
            if($field->type == 'VARCHAR' || $field->type == 'TEXT'){
                self::$searchParams[$field->code] = 'like';
            }elseif($field->type == 'INT') {
                self::$searchParams[$field->code] = '=';
            }
        }
    }

    public static function setLabels()
    {
        foreach(self::$form->rules as $rule) {
            self::$labels[$rule->field->code] = $rule->field->title;
        }
    }

    public static function setFullLabels()
    {
        foreach(self::$entityType->fields as $field) {
            self::$labels[$field->code] = $field->title;
        }
    }

    /**
     * Finds the EntityType model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return EntityTypes the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected static function getEntityType($id)
    {
        if(empty(self::$entityTypes[$id])) {
            if (($model = EntityTypes::findOne($id)) !== null) {
                self::$entityTypes[$id] = $model;
            } else {
                throw new NotFoundHttpException('The requested entity type does not exist.');
            }
        }

        return self::$entityTypes[$id];
    }

    public static function setAction($id)
    {
        if(empty(self::$actions[$id])) {
            if (($model = NodesActions::findOne($id)) !== null) {
                self::$actions[$id] = $model;
            } else {
                throw new NotFoundHttpException('The requested action does not exist.');
            }
        }

        self::$action = self::$actions[$id];

        return self;
    }

    public static function setTask($id)
    {
        if(empty(self::$tasks[$id])) {
            if (($model = Tasks::findOne($id)) !== null) {
                self::$tasks[$id] = $model;
            } else {
                throw new NotFoundHttpException('The requested task does not exist.');
            }
        }

        self::$task = self::$tasks[$id];

        return self;
    }
}