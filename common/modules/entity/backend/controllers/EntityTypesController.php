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
class EntityTypesController extends Controller
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
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
//                    [
//                        'actions' => ['index', 'view'],
//                        'allow' => true,
//                    ],
                    [
                        'actions' => ['index', 'view', 'create', 'update', 'delete', 'build', 'item-view', 'item-create', 'item-update', 'item-delete'],
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
    public function actionIndex()
    {
        $searchModel = new EntityTypesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single EntityTypes model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id, $tab = 1)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
            'tab' => $tab,
        ]);
    }

    /**
     * Creates a new EntityTypes model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new EntityTypes();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing EntityTypes model.
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
     * Deletes an existing EntityTypes model.
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
     * Creates a new EntityTypes container table.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionBuild($id)
    {
        $model = $this->findModel($id);
        $container = EntityContainerFactory::getInstance($model);
        $container->build();
        return $this->redirect(['view', 'id' => $model->id]);
    }

    /**
     * Displays a single EntityType model.
     * @param integer $id
     * @return mixed
     */
    public function actionItemView($id,$item_id)
    {
        $itemModel = Yii::$app->modules[Config::BACKEND_MODULE_NAME]->entityFactory->getFullEntityModel($id, $item_id);

        return $this->render('item/view', [
            'model' => $itemModel->entityType,
            'itemModel' => $itemModel,
        ]);
    }

    /**
     * Creates a new EntityType item model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionItemCreate($id)
    {
        $itemModel = Yii::$app->modules[Config::BACKEND_MODULE_NAME]->entityFactory->getInstanceById($id);

        if ($itemModel->load(Yii::$app->request->post()) && $itemModel->save()) {
            return $this->redirect(['view', 'id' => $itemModel->entityType->id, 'tab' => 6]);
        } else {
            return $this->render('item/create', [
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
    public function actionItemUpdate($id,$item_id)
    {
        $itemModel = Yii::$app->modules[Config::BACKEND_MODULE_NAME]->entityFactory->getFullEntityModel($id, $item_id);

        if ($itemModel->load(Yii::$app->request->post()) && $itemModel->save()) {
            return $this->redirect(['view', 'id' => $itemModel->entityType->id, 'tab' => 6]);
        } else {
            return $this->render('item/update', [
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
    public function actionItemDelete($id,$item_id)
    {
        $itemModel = Yii::$app->modules[Config::BACKEND_MODULE_NAME]->entityFactory->getFullEntityModel($id, $item_id);
        $entity_id = $itemModel->entityType->id;
        $itemModel->delete();

        return $this->redirect(['view', 'id' => $entity_id, 'tab' => 6]);
    }
}
