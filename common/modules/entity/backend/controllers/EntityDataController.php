<?php

namespace common\modules\entity\backend\controllers;

use Yii;
use common\modules\entity\common\models\EntityTypes;
use common\modules\entity\common\models\EntityTypesSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\modules\entity\common\factories\EntityContainerFactory;
use common\modules\entity\common\config\Config;

/**
 * EntityTypesController implements the CRUD actions for EntityTypes model.
 */
class EntityDataController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
//                    'delete' => ['post'],
                ],
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

    /**
     * Lists all EntityTypes models.
     * @return mixed
     */
    public function actionIndex($id)
    {
//        $searchModel = new EntityTypesSearch();
//        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
//
//        return $this->render('index', [
//            'searchModel' => $searchModel,
//            'dataProvider' => $dataProvider,
//        ]);

        return $this->render('index', [
            'model' => $this->findModel($id),
            //'tab' => $tab,
        ]);
    }

    /**
     * Finds the EntityTypes model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return EntityTypes the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = EntityTypes::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Displays a single EntityType model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id,$item_id)
    {
        $itemModel = Yii::$app->modules[Config::BACKEND_MODULE_NAME]->entityFactory->getFullEntityModel($id, $item_id);

        return $this->render('view', [
            'model' => $itemModel->entityType,
            'itemModel' => $itemModel,
        ]);
    }

    /**
     * Creates a new EntityType item model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id)
    {
        $itemModel = Yii::$app->modules[Config::BACKEND_MODULE_NAME]->entityFactory->getInstanceById($id);

        if ($itemModel->load(Yii::$app->request->post()) && $itemModel->save()) {
            return $this->redirect(['index', 'id' => $itemModel->entityType->id]);
        } else {
            return $this->render('create', [
                'model' => $itemModel->entityType,
                'itemModel' => $itemModel,
            ]);
        }
    }

    /**
     * Updates an existing Entity model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id,$item_id)
    {
        $itemModel = Yii::$app->modules[Config::BACKEND_MODULE_NAME]->entityFactory->getFullEntityModel($id, $item_id);

        if ($itemModel->load(Yii::$app->request->post()) && $itemModel->save()) {
            return $this->redirect(['index', 'id' => $itemModel->entityType->id]);
        } else {
            return $this->render('update', [
                'model' => $itemModel->entityType,
                'itemModel' => $itemModel,
            ]);
        }
    }

    /**
     * Deletes an existing Entity model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id,$item_id)
    {
        $itemModel = Yii::$app->modules[Config::BACKEND_MODULE_NAME]->entityFactory->getFullEntityModel($id, $item_id);
        $entity_id = $itemModel->entityType->id;
        $itemModel->delete();

        return $this->redirect(['index', 'id' => $entity_id]);
    }
}
