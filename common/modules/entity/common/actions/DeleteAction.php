<?php
/**
 * Created by PhpStorm.
 * User: a_niyazov
 * Date: 01.09.2015
 * Time: 16:22
 */
namespace common\modules\entity\common\actions;

use Yii;
use yii\web\NotFoundHttpException;


class DeleteAction extends \yii\base\Action
{
    public $id;
    public $tab = 2;
    public $parent_id_filed;
    public $modelClass;
    public $redirect_url;

    public function run()
    {
        $modelClass = $this->modelClass;
        if (($model = $modelClass::findOne($this->id)) !== null) {

            $model_id = $model->{$this->parent_id_filed};
            $model->delete();

            return $this->controller->redirect([$this->redirect_url, 'id' => $model_id, 'tab' => $this->tab]);
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}