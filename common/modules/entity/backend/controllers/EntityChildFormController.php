<?php

namespace common\modules\entity\backend\controllers;

use common\modules\entity\common\actions\FilteredFieldApiAction;
use common\modules\entity\common\models\EntityFields;
use Yii;
use common\modules\entity\common\models\EntityChildForm;
use common\modules\entity\common\models\EntityChildFormSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use common\modules\entity\common\actions\CreateAction;
use common\modules\entity\common\actions\UpdateAction;
use common\modules\entity\common\actions\DeleteAction;
/**
 * EntityChildFormController implements the CRUD actions for EntityChildForm model.
 */
class EntityChildFormController extends Controller
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
                'redirect_url' => 'entity-forms/view',
                'modelClass' => EntityChildForm::className(),
                'parent_id_filed' => 'parent_form_id',
            ],
            'update' => [
                'class' => UpdateAction::className(),
                'id' => Yii::$app->request->get('id'),
                'tab' => 5,
                'redirect_url' => 'entity-forms/view',
                'modelClass' => EntityChildForm::className(),
                'parent_id_filed' => 'parent_form_id',
            ],
            'delete' => [
                'class' => DeleteAction::className(),
                'id' => Yii::$app->request->get('id'),
                'tab' => 5,
                'redirect_url' => 'entity-forms/view',
                'modelClass' => EntityChildForm::className(),
                'parent_id_filed' => 'parent_form_id',
            ],
            'fields' => [
                'class' => FilteredFieldApiAction::className(),
                'object_class' => EntityFields::className(),
                'parent_id' => Yii::$app->request->get('parent_id'),
                'key_field' => 'entity_id',
                'value_field' => 'title',
                'filter_field' => 'entity_id',
            ]
        ];
    }

    /**
     * Lists all EntityChildForm models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new EntityChildFormSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single EntityChildForm model.
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
     * Creates a new EntityChildForm model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new EntityChildForm();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing EntityChildForm model.
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
     * Deletes an existing EntityChildForm model.
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
     * Finds the EntityChildForm model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return EntityChildForm the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = EntityChildForm::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
