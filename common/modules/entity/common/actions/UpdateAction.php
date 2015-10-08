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

class UpdateAction extends \yii\base\Action
{
    public $id;
    public $tab = 2;
    public $parent_id_filed;
    public $modelClass;
    public $redirect_url;
    public $view = 'update';

    public function run()
    {
        $modelClass = $this->modelClass;
        if (($model = $modelClass::findOne($this->id)) !== null) {
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->controller->redirect([$this->redirect_url, 'id' => $model->{$this->parent_id_filed}, 'tab' => $this->tab]);
            } else {
                return $this->controller->render($this->view, [
                    'model' => $model,
                ]);
            }
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}