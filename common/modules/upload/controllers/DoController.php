<?php

namespace common\modules\upload\controllers;

use common\helpers\DebugHelper;
use yii\web\Controller;
use common\modules\upload\components\FileUpload;
use common\modules\upload\models\TasksFiles;

class DoController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionUploadProgress()
    {
        if (isset($_SERVER['HTTP_ORIGIN'])) {
            header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
            header('Access-Control-Allow-Credentials: true');
            header('Access-Control-Max-Age: 86400');    // cache for 1 day
        }

        if (isset($_REQUEST['progresskey'])) {
            $status = apc_fetch('upload_'.$_REQUEST['progresskey']);
        } else {
            exit(json_encode(array('success' => false)));
        }

        $pct = 0;
        $size = 0;

        if (is_array($status)) {

            if (array_key_exists('total', $status) && array_key_exists('current', $status)) {

                if ($status['total'] > 0) {
                    $pct = round(($status['current'] / $status['total']) * 100);
                    $size = round($status['total'] / 1024);
                }
            }
        }

        echo json_encode(array('success' => true, 'pct' => $pct, 'size' => $size));
    }

    public function actionFileUpload($task_id,$node_id,$action_id,$uploadFile)
    {
        $upload_dir = $this->getUploadDirectory($task_id);

        $uploader = new FileUpload('uploadFile');

        $result = $uploader->handleUpload($upload_dir);

        if (!$result) {
            exit(json_encode(array('success' => false, 'msg' => $uploader->getErrorMsg())));
        }

        $taskFile = new TasksFiles();
        $taskFile->task_id = $task_id;
        $taskFile->node_id = $node_id;
        $taskFile->action_id = $action_id;
        $taskFile->name = $uploader->getFileName();
        $taskFile->ext = $uploader->getExtension();
        $taskFile->directoryPath = $uploader->getSavedFile();
        $taskFile->urlPath = '/uploads/'.date('Y').'/'.date('m').'/'.$task_id.'/'.$uploader->getFileName();
        if($taskFile->save()) {
            echo json_encode([
                'success' => true,
                'task_id' => $task_id,
                'node_id' => $node_id,
                'action_id' => $action_id,
            ]);
        }else{
            echo json_encode(['success' => false, 'msg' => 'Несохранен путь к файлу в задаче']);
        }

    }

    public function beforeAction($action) {
        $this->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }

    private function getUploadDirectory($task_id)
    {
        $uploadDirectory = \Yii::$app->basePath.'/web/uploads/'.date('Y');
        if(!is_dir($uploadDirectory)){
            mkdir($uploadDirectory);
        }
        $uploadDirectory = $uploadDirectory.'/'.date('m');
        if(!is_dir($uploadDirectory)){
            mkdir($uploadDirectory);
        }
        $uploadDirectory = $uploadDirectory.'/'.$task_id;
        if(!is_dir($uploadDirectory)){
            mkdir($uploadDirectory);
        }
        return $uploadDirectory;
    }

}
