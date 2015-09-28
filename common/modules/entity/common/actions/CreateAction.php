<?php
/**
 * Created by PhpStorm.
 * User: a_niyazov
 * Date: 01.09.2015
 * Time: 16:22
 */
namespace common\modules\entity\common\actions;

use Yii;

class CreateAction extends \yii\base\Action
{
    public $parent_id;
    public $tab = 2;
    public $redirect_url;
    public $modelClass;
    public $parent_id_filed;
    public $view = 'create';

    public function run()
    {
        $model = new $this->modelClass;
        $model->{$this->parent_id_filed} = $this->parent_id;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->controller->redirect([$this->redirect_url, 'id' => $model->{$this->parent_id_filed}, 'tab' => $this->tab]);
        } else {
            return $this->controller->render($this->view, [
                'model' => $model,
            ]);
        }
    }
}