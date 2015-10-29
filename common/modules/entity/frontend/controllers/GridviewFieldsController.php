<?php

namespace common\modules\entity\frontend\controllers;

use common\modules\entity\common\models\EntityFields;
use Yii;
use common\modules\entity\common\models\permission\GridviewFields;
use common\modules\entity\common\models\permissionGridviewFieldsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use common\modules\entity\common\actions\CreateAction;
use common\modules\entity\common\actions\UpdateAction;
use common\modules\entity\common\actions\DeleteAction;

/**
 * GridviewFieldsController implements the CRUD actions for GridviewFields model.
 */
class GridviewFieldsController extends Controller
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
//            'create' => [
//                'class' => CreateAction::className(),
//                'parent_id' => Yii::$app->request->get('parent_id'),
//                'tab' => 2,
//                'redirect_url' => 'gridviews/view',
//                'modelClass' => GridviewFields::className(),
//                'parent_id_filed' => 'gridview_id',
//            ],
            'update' => [
                'class' => UpdateAction::className(),
                'id' => Yii::$app->request->get('id'),
                'tab' => 2,
                'redirect_url' => 'gridviews/view',
                'modelClass' => GridviewFields::className(),
                'parent_id_filed' => 'gridview_id',
            ],
            'delete' => [
                'class' => DeleteAction::className(),
                'id' => Yii::$app->request->get('id'),
                'tab' => 2,
                'redirect_url' => 'gridviews/view',
                'modelClass' => GridviewFields::className(),
                'parent_id_filed' => 'gridview_id',
            ]
        ];
    }

    /**
     * Lists all GridviewFields models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new permissionGridviewFieldsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single GridviewFields model.
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
     * Creates a new GridviewFields model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($parent_id)
    {
        $model = new GridviewFields();
        $model->gridview_id = $parent_id;

        if ($model->load(Yii::$app->request->post())) {
            if(empty($model->order))  $model->order = 100;
            if ($model->save()) {
                return $this->redirect(['gridviews/view', 'id' => $model->gridview_id]);
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);

    }

    /**
     * Updates an existing GridviewFields model.
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
     * Deletes an existing GridviewFields model.
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
     * Finds the GridviewFields model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return GridviewFields the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = GridviewFields::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionColumns($id)
    {
        $arItems = [];
        $items = EntityFields::find()->where(['entity_id' => $id])->all();
        foreach($items as $item){
            $arItems[] = ['value' => $item->id, 'label' => $item->title];
        }
        echo json_encode($arItems);
    }
}
