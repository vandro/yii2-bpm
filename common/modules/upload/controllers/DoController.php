<?php

namespace common\modules\upload\controllers;

use yii\web\Controller;
use common\modules\upload\components\FileUpload;

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

    public function actionFileUpload($uploadFile)
    {
        $upload_dir = '/var/www/yagonaoyna/development/dev1/frontend/web/uploads'; ///var/www/yagonaoyna/development/dev1/common/modules/upload/controllers

        $uploader = new FileUpload('uploadFile');

        // Handle the upload
        $result = $uploader->handleUpload($upload_dir);

        if (!$result) {
            exit(json_encode(array('success' => false, 'msg' => $uploader->getErrorMsg())));
        }

        echo json_encode(array('success' => true));
//        echo __DIR__.'/../../../frontend/web/uploads';
    }

    public function beforeAction($action) {
        $this->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }

}
