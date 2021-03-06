<?php

namespace common\modules\entity\frontend\controllers;

//use common\modules\entity\common\factories\BehaviorClassFactory;
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

    public function actionTest()
    {
        $specializations = SmiSpecialization::find()->all();
        $founders = SmiFounders::find()->all();

        foreach($founders as $founder) {
            DebugHelper::printSingleObject(count(SmiReestr::find()->founder($founder)->all()));
        }
//        return $this->render('index2');
    }

    public function actionDraw()
    {
        return $this->render('draw');
    }

    public function actionConfig($id)
    {
        DebugHelper::printSingleObject(json_decode(file_get_contents('http://official2.gov.uz/getConfig/'.$id)));
    }
}
