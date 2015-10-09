<?php

namespace common\modules\epigu\controllers;

use common\helpers\DebugHelper;
use common\modules\epigu\components\Integration;
use yii\web\Controller;

class DefaultController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionGetTasks($id)
    {
        DebugHelper::printSingleObject(Integration::getAllTasks($id));
    }

    public function actionGetTask($id)
    {
        DebugHelper::printSingleObject(Integration::getTask($id));
    }

    public function actionGetConfig($id)
    {
        DebugHelper::printSingleObject(Integration::getConfig($id));
    }

    public function actionTest()
    {
        DebugHelper::printSingleObject(\Yii::$app->basePath);
        DebugHelper::printSingleObject(__DIR__);
    }
}
