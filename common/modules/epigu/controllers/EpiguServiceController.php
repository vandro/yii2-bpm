<?php

namespace common\modules\epigu\controllers;

use common\helpers\DebugHelper;
use common\modules\entity\common\models\EntityFields;
use common\modules\entity\common\models\EntityTypes;
use common\modules\epigu\components\Integration;
use common\modules\epigu\models\EpiguServiceFileds;
use Yii;
use common\modules\epigu\models\EpiguService;
use common\modules\epigu\models\EpiguServiceSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * EpiguServiceController implements the CRUD actions for EpiguService model.
 */
class EpiguServiceController extends Controller
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
     * Lists all EpiguService models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new EpiguServiceSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single EpiguService model.
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
     * Creates a new EpiguService model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new EpiguService();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    public function actionAddFieldsToEntity($id, $entity_type_id, $tab)
    {
        $arFieldsNames = [];
        $arFieldsIds = Yii::$app->request->post('fields');
        foreach($arFieldsIds as $fieldId){
            $serviceField = EpiguServiceFileds::findOne($fieldId);
            $result = EntityFields::find()->where(['code' => $serviceField->name, 'entity_id' => $entity_type_id])->all();
            if(empty($result)) {
                $entityField = new EntityFields();
                $entityField->entity_id = $entity_type_id;
                $entityField->title = $serviceField->label_ru;
                $entityField->code = $serviceField->name;
                $entityField->type = $serviceField->getEntityFieldType();
                $entityField->length = $serviceField->getEntityFieldLength();
                $entityField->save();
                $arFieldsNames[] = $serviceField->name;
            }
        }
        echo json_encode($arFieldsNames);
    }

    /**
     * Updates an existing EpiguService model.
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
     * Deletes an existing EpiguService model.
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
     * Finds the EpiguService model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return EpiguService the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = EpiguService::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Add fields to an existing EpiguService model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionAddFields($id)
    {
        $model = $this->findModel($id);
        $config = json_decode(Integration::getConfig($model->epugi_id), true);

        foreach($config['fields'] as $field){
            $searchField = EpiguServiceFileds::find()->where(['name' => $field['name']])->one();
            if(empty($searchField)) {
                $fieldModel = new EpiguServiceFileds();
                $fieldModel->attributes = $field;
                $fieldModel->epigu_service_id = $id;
                $fieldModel->epigu_fileld_id = $field['id'];
                $fieldModel->group = is_array($field['group']) ? json_encode($field['group']) : '';
                $fieldModel->save();
            }
        }

        return $this->redirect(['view', 'id' => $model->id, 'tab' => 2]);
    }

    /**
     * Delete all fields from an existing EpiguService model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDeleteFields($id)
    {
        $model = $this->findModel($id);

        foreach($model->epiguServiceFileds as $field){
            $field->delete();
        }

        return $this->redirect(['view', 'id' => $model->id, 'tab' => 2]);
    }

    public function actionAddEntityFields($id, $entity_type_id)
    {
        $model = $this->findModel($id);
        $entityType = $this->findEntityType($entity_type_id);

        return $this->render('addFieldsView', [
            'model' => $model,
            'entityType' => $entityType,
        ]);
    }

    protected function findEntityType($id)
    {
        if (($model = EntityTypes::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
