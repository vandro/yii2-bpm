<?php
/**
 * Created by PhpStorm.
 * User: a_niyazov
 * Date: 04.10.2015
 * Time: 11:38
 */
namespace common\modules\upload\widgets;

use Yii;

class MegaFileUploadWidget extends \yii\bootstrap\Widget
{
    public $name = 'uploadFile';
    public $multipart = 'true';
    public $hoverClass = 'hover';
    public $focusClass = 'focus';
    public $responseType = 'json';
    public $taskId = null;
    public $nodeId = null;
    public $actionId = null;

    public function run(){

        $params = [];
        if(!empty($this->taskId)){
            $params['task_id'] = $this->taskId;
        }

        if(!empty($this->nodeId)){
            $params['node_id'] = $this->nodeId;
        }

        if(!empty($this->actionId)){
            $params['action_id'] = $this->actionId;
        }

        return $this->render('megaFileUploadWidgetView',[
            'url' => Yii::$app->getUrlManager()->createAbsoluteUrl(array_merge(['upload/do/file-upload'], $params)),
            'progressUrl' => Yii::$app->getUrlManager()->createAbsoluteUrl('upload/do/upload-progress'),
            'name' => $this->name,
            'multipart' => $this->multipart,
            'hoverClass' => $this->hoverClass,
            'focusClass' => $this->focusClass,
            'responseType' => $this->responseType,
        ]);
    }

}