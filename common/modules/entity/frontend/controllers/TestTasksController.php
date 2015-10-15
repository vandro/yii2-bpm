<?php

namespace common\modules\entity\frontend\controllers;

//use common\modules\entity\common\factories\BehaviorClassFactory;
use common\modules\entity\common\factories\ActiveRecordClassFactory;
use common\modules\entity\common\factories\ActiveRecordStringRuleFactory;
use common\modules\entity\common\factories\EntityClassFactory;
use common\modules\entity\common\factories\EntityFormClassFactory;
use common\modules\entity\common\models\EntityForms;
use common\modules\entity\common\models\EntityTypes;
use common\modules\entity\common\models\NodesActions;
use common\modules\entity\common\models\smi\SmiFounders;
use common\modules\entity\common\models\smi\SmiReestr;
use common\modules\entity\common\models\smi\SmiSpecialization;
use Yii;
use common\modules\entity\common\models\permission\Tasks;
use common\modules\entity\common\models\permission\TasksSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\helpers\DebugHelper;
use common\modules\entity\common\factories\BehaviorClassFactory;

/**
 * TestTasksController implements the CRUD actions for Tasks model.
 */
class TestTasksController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Tasks models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TasksSearch();
        $dataProvider = $searchModel->searchActive(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Tasks model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Tasks model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Tasks();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Tasks model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Tasks model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Tasks model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Tasks the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Tasks::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionGetTasks($id)
    {
        DebugHelper::printSingleObject(\common\modules\entity\common\components\Integration::getAllTasks($id));
    }

    public function actionGetTask($id)
    {
        DebugHelper::printSingleObject(\common\modules\entity\common\components\Integration::getTask($id));
    }

    public function actionCode()
    {
        $params = [
            BehaviorClassFactory::NAME_SPACE => 'common\modules\entity\common\behaviors',
            BehaviorClassFactory::CLASS_NAME => 'Request',
            BehaviorClassFactory::PROPERTIES => [
                [BehaviorClassFactory::PROPERTY_NAME => 'title_string'],
                [BehaviorClassFactory::PROPERTY_NAME => 'code_string'],
                [BehaviorClassFactory::PROPERTY_NAME => 'balans_string'],
            ],
        ];

//        DebugHelper::printSingleObject(BehaviorClassFactory::getClassString($params));

        file_put_contents(Yii::$app->basePath.'/../common/modules/entity/common/behaviors/RequestBehaviors.php',BehaviorClassFactory::getClassString($params));
    }

    public function actionCreateEntity($id)
    {

        if (EntityClassFactory::generateFile($id)) {
            echo 'Generated';
        } else {
            echo 'Not';
        }
    }

    public function actionTestCreateEntity()
    {
        $params = [
            ActiveRecordClassFactory::NAME_SPACE => 'common\modules\entity\common\entities',
            ActiveRecordClassFactory::CLASS_NAME => 'RequestRelation',
            ActiveRecordClassFactory::ACTIVE_QUERY_CLASS_NAME => 'RequestQuery',
            ActiveRecordClassFactory::TABLE_NAME => 'request',
            ActiveRecordClassFactory::AUTHOR_NAME => 'Avazbek Niyazov',
            ActiveRecordClassFactory::I18N_MESSAGE_FILE_ALIAS => 'app',
            ActiveRecordClassFactory::DATABASE_NAME => 'pdb',
            ActiveRecordClassFactory::CLASS_FILE_LOCATION_PATH => Yii::$app->basePath.'/../common/modules/entity/common/entities/',
            ActiveRecordClassFactory::PROPERTIES_VALIDATION_RULES => [
                'string' => [
                    ActiveRecordClassFactory::CLASS_NAME => '\common\modules\entity\common\factories\ActiveRecordStringRuleFactory',
                ],
                'integer' => [
                    ActiveRecordClassFactory::CLASS_NAME => '\common\modules\entity\common\factories\ActiveRecordIntegerRuleFactory',
                ],
                'email' => [
                    ActiveRecordClassFactory::CLASS_NAME => '\common\modules\entity\common\factories\ActiveRecordEmailRuleFactory',
                ],
            ],
            ActiveRecordClassFactory::PROPERTIES => [
                [
                    ActiveRecordClassFactory::PROPERTY_NAME => 'title_string',
                    ActiveRecordClassFactory::PROPERTY_TYPE => 'string',
                    ActiveRecordClassFactory::PROPERTY_LABEL => 'Наименование',
                    ActiveRecordClassFactory::PROPERTY_VALIDATION_RULES => [
                        [
                            ActiveRecordClassFactory::PROPERTY_VALIDATION_RULE_TYPE => 'string',
                            ActiveRecordStringRuleFactory::MAX => 255,
                        ],
                    ],
                ],
                [
                    ActiveRecordClassFactory::PROPERTY_NAME => 'entity_type_id',
                    ActiveRecordClassFactory::PROPERTY_TYPE => 'integer',
                    ActiveRecordClassFactory::PROPERTY_LABEL => 'Тип сущности',
                    ActiveRecordClassFactory::PROPERTY_VALIDATION_RULES => [
                        [
                            ActiveRecordClassFactory::PROPERTY_VALIDATION_RULE_TYPE => 'integer',
                        ],
                    ],
                    ActiveRecordClassFactory::PROPERTY_RELATION => [
                        ActiveRecordClassFactory::PROPERTY_RELATION_METHOD_NAME => 'EntityType',
                        ActiveRecordClassFactory::PROPERTY_RELATION_TYPE => ActiveRecordClassFactory::RELATION_TYPE_HAS_MANY,
                        ActiveRecordClassFactory::PROPERTY_RELATION_FOREIGN_KEY => 'entity_type_id',
                        ActiveRecordClassFactory::PROPERTY_RELATION_TARGET_KEY => 'id',
                        ActiveRecordClassFactory::PROPERTY_RELATION_TARGET_CLASS => 'EntityType',
                    ],
                ],
                [
                    ActiveRecordClassFactory::PROPERTY_NAME => 'name',
                    ActiveRecordClassFactory::PROPERTY_TYPE => 'string',
                    ActiveRecordClassFactory::PROPERTY_LABEL => 'Наименование',
                    ActiveRecordClassFactory::PROPERTY_VALIDATION_RULES => [
                        [
                            ActiveRecordClassFactory::PROPERTY_VALIDATION_RULE_TYPE => 'string',
                        ],
                    ]
                ],
                [
                    ActiveRecordClassFactory::PROPERTY_NAME => 'code_string',
                    ActiveRecordClassFactory::PROPERTY_TYPE => 'string',
                    ActiveRecordClassFactory::PROPERTY_LABEL => 'Код',
                    ActiveRecordClassFactory::PROPERTY_VALIDATION_RULES => [
                        [
                            ActiveRecordClassFactory::PROPERTY_VALIDATION_RULE_TYPE => 'string',
                            ActiveRecordStringRuleFactory::MAX => 255,
                            ActiveRecordStringRuleFactory::MIN => 50,
                        ],
                    ]
                ],
                [
                    ActiveRecordClassFactory::PROPERTY_NAME => 'balans',
                    ActiveRecordClassFactory::PROPERTY_TYPE => 'integer',
                    ActiveRecordClassFactory::PROPERTY_LABEL => 'Баланс',
                    ActiveRecordClassFactory::PROPERTY_VALIDATION_RULES => [
                        [
                            ActiveRecordClassFactory::PROPERTY_VALIDATION_RULE_TYPE => 'integer',
                            ActiveRecordStringRuleFactory::MAX => 150,
                        ],
                    ]
                ],
                [
                    ActiveRecordClassFactory::PROPERTY_NAME => 'email',
                    ActiveRecordClassFactory::PROPERTY_TYPE => 'string',
                    ActiveRecordClassFactory::PROPERTY_LABEL => 'Адрес электронной почты',
                    ActiveRecordClassFactory::PROPERTY_VALIDATION_RULES => [
                        [
                            ActiveRecordClassFactory::PROPERTY_VALIDATION_RULE_TYPE => 'email',
                        ],
                    ]
                ],
            ],
        ];

        if(ActiveRecordClassFactory::generateClassFile($params)){
            echo 'Generated';
        }else{
            echo 'Not';
        }


//        DebugHelper::printSingleObject(BehaviorClassFactory::getClassString($params));

//        file_put_contents(Yii::$app->basePath.'/../common/modules/entity/common/entities/RequestEntity.php',ActiveRecordClassFactory::getClassString($params));
    }

    public function getName($nameString)
    {
        $name = '';
        $arName = explode("_",$nameString);
        foreach($arName as $nameItem){
            $name .= ucfirst($nameItem);
        }

        return $name;
    }

    public function actionTestEntityClass($id)
    {
        $entityType = EntityTypes::findOne($id);
        $className = '\\common\\modules\\entity\\common\\entities\\'.$this->getName($entityType->code);
        DebugHelper::printActiveRecordsArray($className::find()->all());
    }

    public function actionTestEntityFormClass($id)
    {
        $entityForm = EntityForms::findOne($id);
        $className = '\\common\\modules\\entity\\common\\entities\\forms\\'.$this->getName($entityForm->code).'Form';
        DebugHelper::printActiveRecordsArray($className::find()->all());
    }

    public function actionCreateEntityForm($id)
    {

        if (EntityFormClassFactory::generateFile($id)) {
            echo 'Generated';
        } else {
            echo 'Not';
        }
    }

    public function actionDraw()
    {
        return $this->render('draw');
    }

    public function actionConfig($id)
    {
        DebugHelper::printSingleObject(json_decode(file_get_contents('http://official2.gov.uz/getConfig/'.$id)));
    }

    public function actionGetHandlers($id)
    {
        $action = NodesActions::findOne($id);
        DebugHelper::printSingleObject($action->handlers);
    }
}
