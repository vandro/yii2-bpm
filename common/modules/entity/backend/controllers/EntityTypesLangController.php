<?php

namespace common\modules\entity\backend\controllers;


use Yii;
use yii\filters\AccessControl;
use common\modules\entity\common\models\EntityTypesLang;
use common\modules\entity\common\models\EntityTypesLangSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use common\modules\entity\common\actions\CreateAction;
use common\modules\entity\common\actions\UpdateAction;
use common\modules\entity\common\actions\DeleteAction;

/**
 * EntityTypesLangController implements the CRUD actions for EntityTypesLang model.
 */
class EntityTypesLangController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
//                'actions' => [
//                    'delete' => ['post'],
//                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
//                    [
//                        'actions' => ['index', 'view'],
//                        'allow' => true,
//                    ],
                    [
                        'actions' => ['index', 'view', 'create', 'update', 'delete'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
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
                'tab' => 2,
                'redirect_url' => 'entity-types/view',
                'modelClass' => EntityTypesLang::className(),
                'parent_id_filed' => 'main',
            ],
            'update' => [
                'class' => UpdateAction::className(),
                'id' => Yii::$app->request->get('id'),
                'tab' => 2,
                'redirect_url' => 'entity-types/view',
                'modelClass' => EntityTypesLang::className(),
                'parent_id_filed' => 'main',
            ],
            'delete' => [
                'class' => DeleteAction::className(),
                'id' => Yii::$app->request->get('id'),
                'tab' => 2,
                'redirect_url' => 'entity-types/view',
                'modelClass' => EntityTypesLang::className(),
                'parent_id_filed' => 'main',
            ]
        ];
    }

    /**
     * Lists all EntityTypesLang models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new EntityTypesLangSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single EntityTypesLang model.
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
     * Creates a new EntityTypesLang model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
//    public function actionCreate($entity_type_id, $tab = 2)
//    {
//        $model = new EntityTypesLang();
//        $model->main = $entity_type_id;
//
//        if ($model->load(Yii::$app->request->post()) && $model->save()) {
//            return $this->redirect(['entity-types/view', 'id' => $model->main, 'tab' => $tab]);
//        } else {
//            return $this->render('create', [
//                'model' => $model,
//            ]);
//        }
//    }

    /**
     * Updates an existing EntityTypesLang model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
//    public function actionUpdate($id, $tab = 2)
//    {
//        $model = $this->findModel($id);
//
//        if ($model->load(Yii::$app->request->post()) && $model->save()) {
//            return $this->redirect(['entity-types/view', 'id' => $model->id, 'tab' => $tab]);
//        } else {
//            return $this->render('update', [
//                'model' => $model,
//            ]);
//        }
//    }

    /**
     * Deletes an existing EntityTypesLang model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
//    public function actionDelete($id, $tab = 2)
//    {
//        $model = $this->findModel($id);
//        $model_id = $model->id;
//        $model->delete();
//
//        return $this->redirect(['entity-types/view', 'id' => $model_id, 'tab' => $tab]);
//    }

    /**
     * Finds the EntityTypesLang model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return EntityTypesLang the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = EntityTypesLang::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
