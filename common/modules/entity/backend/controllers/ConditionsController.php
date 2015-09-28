<?php

namespace common\modules\entity\backend\controllers;

use common\modules\entity\common\models\EntityFields;
use Yii;
use common\modules\entity\common\models\permission\NodesConditions;
use common\modules\entity\common\models\permission\NodesConditionsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use common\modules\entity\common\actions\CreateAction;
use common\modules\entity\common\actions\UpdateAction;
use common\modules\entity\common\actions\DeleteAction;
/**
 * ConditionsController implements the CRUD actions for NodesConditions model.
 */
class ConditionsController extends Controller
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

    public function actions()
    {
        return [
            'create' => [
                'class' => CreateAction::className(),
                'parent_id' => Yii::$app->request->get('parent_id'),
                'tab' => 5,
                'redirect_url' => 'process-nodes/view',
                'modelClass' => NodesConditions::className(),
                'parent_id_filed' => 'node_id',
            ],
            'update' => [
                'class' => UpdateAction::className(),
                'id' => Yii::$app->request->get('id'),
                'tab' => 5,
                'redirect_url' => 'process-nodes/view',
                'modelClass' => NodesConditions::className(),
                'parent_id_filed' => 'node_id',
            ],
            'delete' => [
                'class' => DeleteAction::className(),
                'id' => Yii::$app->request->get('id'),
                'tab' => 5,
                'redirect_url' => 'process-nodes/view',
                'modelClass' => NodesConditions::className(),
                'parent_id_filed' => 'node_id',
            ]
        ];
    }

    /**
     * Lists all NodesConditions models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new NodesConditionsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single NodesConditions model.
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
     * Creates a new NodesConditions model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new NodesConditions();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing NodesConditions model.
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
     * Deletes an existing NodesConditions model.
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
     * Finds the NodesConditions model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return NodesConditions the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = NodesConditions::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Displays a data sets.
     * @param string $params
     * @return json
     */
    public function actionFields($id)
    {
        $arItems = [];
        $items = EntityFields::find()->where(['entity_id' => $id])->all();
        foreach($items as $item){
            $arItems[] = ['value' => $item->id, 'label' => $item->title];
        }
        echo json_encode($arItems);
    }

    public function actionAddTrueAction($id)
    {
        $model = $this->findModel($id);
        $model->true_next_exec_type = 'action';

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('_addTrueActionForm', [
                'model' => $model,
            ]);
        }
    }

    public function actionAddFalseAction($id)
    {
        $model = $this->findModel($id);
        $model->false_next_exec_type = 'action';

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('_addFalseActionForm', [
                'model' => $model,
            ]);
        }
    }

    public function actionAddTrueCondition($node_id, $parent_id)
    {
        $model = new NodesConditions();
        $model->node_id = $node_id;
        $model->true_next_exec_type = 'condition';

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $parent = $this->findModel($parent_id);
            $parent->true_condition_id = $model->id;
            if($parent->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            return $this->render('_addConditionForm', [
                'model' => $model,
            ]);
        }
    }

    public function actionAddFalseCondition($node_id, $parent_id)
    {
        $model = new NodesConditions();
        $model->node_id = $node_id;
        $model->false_next_exec_type = 'condition';

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $parent = $this->findModel($parent_id);
            $parent->true_condition_id = $model->id;
            if($parent->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            return $this->render('_addConditionForm', [
                'model' => $model,
            ]);
        }
    }
}
