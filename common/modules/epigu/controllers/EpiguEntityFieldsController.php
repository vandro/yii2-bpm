<?php

namespace common\modules\epigu\controllers;

use common\modules\entity\common\models\EntityFields;
use common\modules\epigu\models\EpiguServiceFileds;
use Yii;
use common\modules\epigu\models\EpiguAndEntityFieldsLink;
use common\modules\epigu\models\EpiguAndEntityFieldsLinkSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use common\modules\entity\common\actions\CreateAction;
use common\modules\entity\common\actions\UpdateAction;
use common\modules\entity\common\actions\DeleteAction;
/**
 * EpiguEntityFieldsController implements the CRUD actions for EpiguAndEntityFieldsLink model.
 */
class EpiguEntityFieldsController extends Controller
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
                'tab' => 2,
                'redirect_url' => 'inaction-entity/view',
                'modelClass' => EpiguAndEntityFieldsLink::className(),
                'parent_id_filed' => 'in_action_entity_link_id',
            ],
            'update' => [
                'class' => UpdateAction::className(),
                'id' => Yii::$app->request->get('id'),
                'tab' => 2,
                'redirect_url' => 'inaction-entity/view',
                'modelClass' => EpiguAndEntityFieldsLink::className(),
                'parent_id_filed' => 'in_action_entity_link_id',
            ],
            'delete' => [
                'class' => DeleteAction::className(),
                'id' => Yii::$app->request->get('id'),
                'tab' => 2,
                'redirect_url' => 'inaction-entity/view',
                'modelClass' => EpiguAndEntityFieldsLink::className(),
                'parent_id_filed' => 'in_action_entity_link_id',
            ]
        ];
    }

    /**
     * Lists all EpiguAndEntityFieldsLink models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new EpiguAndEntityFieldsLinkSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single EpiguAndEntityFieldsLink model.
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
     * Creates a new EpiguAndEntityFieldsLink model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new EpiguAndEntityFieldsLink();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing EpiguAndEntityFieldsLink model.
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
     * Deletes an existing EpiguAndEntityFieldsLink model.
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
     * Finds the EpiguAndEntityFieldsLink model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return EpiguAndEntityFieldsLink the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = EpiguAndEntityFieldsLink::findOne($id)) !== null) {
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
    public function actionEpiguServiceFields($id)
    {
        $arItems = [];
        $items = EpiguServiceFileds::find()->where(['epigu_service_id' => $id])->all();
        foreach($items as $item){
            $arItems[] = ['value' => $item->id, 'label' => $item->label_ru];
        }
        echo json_encode($arItems);
    }

    /**
     * Displays a data sets.
     * @param string $params
     * @return json
     */
    public function actionEntityFields($id)
    {
        $arItems = [];
        $items = EntityFields::find()->where(['entity_id' => $id])->all();
        foreach($items as $item){
            $arItems[] = ['value' => $item->id, 'label' => $item->title];
        }
        echo json_encode($arItems);
    }
}
