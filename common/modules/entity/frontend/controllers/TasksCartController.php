<?php

namespace common\modules\entity\frontend\controllers;

use common\helpers\DebugHelper;
use common\models\User;
use common\modules\entity\common\components\AccessRule;
use common\modules\entity\common\components\TaskAccessRule;
use common\modules\entity\common\config\Config;
use common\modules\entity\common\models\permission\Gridviews;
use Yii;
use common\modules\entity\common\models\TasksCart;
use common\modules\entity\common\models\TasksCartSearch;
use common\modules\entity\common\models\permission\Tasks;
use common\modules\entity\common\models\permission\TasksSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\modules\entity\common\models\Processes;

/**
 * TasksCartController implements the CRUD actions for TasksCart model.
 */
class TasksCartController extends Controller
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
//            'access' => [
//                'class' => AccessControl::className(),
//                // We will override the default rule config with the new AccessRule class
//                'ruleConfig' => [
//                    'class' => AccessRule::className(),
//                ],
//                'only' => ['create', 'update', 'delete'],
//                'rules' => [
//                    [
//                        'actions' => ['create'],
//                        'allow' => true,
//                        // Allow users, moderators and admins to create
//                        'roles' => [
//                            User::ROLE_USER,
//                            User::ROLE_MODERATOR,
//                            User::ROLE_ADMIN
//                        ],
//                        'request' => Yii::$app->request,
//                    ],
//                    [
//                        'actions' => ['update'],
//                        'allow' => true,
//                        // Allow moderators and admins to update
//                        'roles' => [
//                            User::ROLE_MODERATOR,
//                            User::ROLE_ADMIN
//                        ],
//                    ],
//                    [
//                        'actions' => ['delete','view'],
//                        'allow' => true,
//                        // Allow admins to delete
//                        'roles' => [
//                            User::ROLE_ADMIN,
//
//                        ],
//                    ],
//                ],
//            ],
        ];
    }

    public $layout = 'main';

    /**
     * Lists all TasksCart models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TasksCartSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Lists all TasksCart models.
     * @return mixed
     */
    public function actionActive()
    {
        $searchModel = new TasksSearch();
        $dataProvider = $searchModel->searchActive(Yii::$app->request->queryParams);

        Yii::$app->cache->set('action'.Yii::$app->user->id, 'active');

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'gridViewsUrls' => $this->getGridViewsUrls(),
            'view' => Gridviews::findOne(Yii::$app->request->get('views_id')),
            'actionName' => 'active',
        ]);
    }

    /**
     * Lists all TasksCart models.
     * @return mixed
     */
    public function actionInactive()
    {
        $searchModel = new TasksSearch();
        $dataProvider = $searchModel->searchInActive(Yii::$app->request->queryParams);

        Yii::$app->cache->set('action'.Yii::$app->user->id, 'inactive');

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'gridViewsUrls' => $this->getGridViewsUrls(),
            'view' => Gridviews::findOne(Yii::$app->request->get('views_id')),
            'actionName' => 'inactive',
        ]);
    }

    /**
     * Lists all TasksCart models.
     * @return mixed
     */
    public function actionClosed()
    {
        $searchModel = new TasksSearch();
        $dataProvider = $searchModel->searchClosed(Yii::$app->request->queryParams);

        Yii::$app->cache->set('action'.Yii::$app->user->id, 'closed');

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'gridViewsUrls' => $this->getGridViewsUrls(),
            'view' => Gridviews::findOne(Yii::$app->request->get('views_id')),
            'actionName' => 'closed',
        ]);
    }

    /**
     * Displays a single TasksCart model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        return $this->redirect(['nodes-cart/view',
            'id' => $model->current_node_id,
            'task_id' =>$model->id,
        ]);
    }

    /**
     * Creates a new TasksCart model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id)
    {
        $this->layout = 'mainWithNoLeftMenu';

        $service = Processes::findOne($id);
        $user = \common\modules\entity\common\models\permission\User::findOne(Yii::$app->user->id);
        if(!empty($service)) {
            $model = new Tasks();
            if(!empty($user->organisation_id)) {
                DebugHelper::printSingleObject('dsfadsf');
                $model->process_id = $id;
                $model->author_id = Yii::$app->user->id;
                $model->organisation_id = $user->organisation_id;
                $model->department_id = $user->department_id;
                foreach ($service->nodes as $node) {
                    if ($node->is_first()) {
                        $model->current_node_id = $node->id;
                        if ($model->save()) {
                            return $this->redirect(['nodes-cart/view', 'id' => $node->id, 'task_id' => $model->id]);
                        } else {
                            throw new NotFoundHttpException('The service task not saved.');
                        }
                    }
                }
                throw new NotFoundHttpException('The service does not have first node.');
            }else{

                $model->process_id = $id;
                $model->author_id = Yii::$app->user->id;
                foreach ($service->nodes as $node) {
                    if ($node->is_first()) {
                        $model->current_node_id = $node->id;
                        if ($model->load(Yii::$app->request->post())) {
                            $model->department_id = $model->organization->getProcessDepartmentsId($model->process_id);
                            if ($model->save()) {
                                return $this->redirect(['nodes-cart/view', 'id' => $node->id, 'task_id' => $model->id]);
                            }else {
                                throw new NotFoundHttpException('The service task not saved.');
                            }
                        }else {
                            return $this->render('create', [
                                'model' => $model,
                            ]);
                        }
                    }
                }
                throw new NotFoundHttpException('The service does not have first node.');
            }

        }else{
            throw new NotFoundHttpException('The service #'.$id.' does not exist.');
        }
    }

    /**
     * Updates an existing TasksCart model.
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
     * Deletes an existing TasksCart model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect([Yii::$app->cache->get('action'.Yii::$app->user->id)]);
    }

    /**
     * Finds the TasksCart model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TasksCart the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TasksCart::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function getGridViewsUrls()
    {
        $items = [];
        $items[] = ['label' => 'Add view', 'url' => Yii::$app->getUrlManager()->createUrl([Config::MODULE_NAME . '/gridviews/create', 'action' => $this->action->id])];
        $items[] = '<li class="divider"></li>';

        $gridViews = Gridviews::find()->where(['user_id' => Yii::$app->user->id])->all();

        foreach ($gridViews as $views) {

            $items[] = ['label' => $views->title, 'url' => Yii::$app->getUrlManager()->createUrl([Config::MODULE_NAME . '/tasks-cart/'.$this->action->id, 'views_id' => $views->id])];

        }


        return $items;
    }

    public function actionTest()
    {

    }
}
