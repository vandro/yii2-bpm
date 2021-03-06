<?php

namespace common\modules\entity\common\models;

use common\helpers\DebugHelper;
use backend\models\User;
use common\modules\entity\common\config\Config;
use common\modules\upload\models\TasksFiles;
use Yii;
use yii\data\ActiveDataProvider;
use yii\grid\GridView;
use yii\helpers\Html;

/**
 * This is the model class for table "tasks_cart".
 *
 * @property integer $id
 * @property integer $process_id
 * @property integer $author_id
 * @property integer $current_node_id
 * @property string $created_at
 */
class TasksCart extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tasks_cart';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('pdb');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['process_id', 'author_id', 'current_node_id'], 'required'],
            [['process_id', 'author_id', 'current_node_id'], 'integer'],
            [['created_at'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'process_id' => Yii::t('app', 'Process ID'),
            'author_id' => Yii::t('app', 'Author ID'),
            'current_node_id' => Yii::t('app', 'Current Node ID'),
            'created_at' => Yii::t('app', 'Created At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProcess()
    {
        return $this->hasOne(Processes::className(), ['id' => 'process_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCurrentNode()
    {
        return $this->hasOne(ProcessNodes::className(), ['id' => 'current_node_id']);
    }

    public function getEntitiesLink()
    {
        return $this->hasMany(TasksEntitiesLink::className(), ['task_id' => 'id']);
    }

    public function renderViews($node)
    {
        $userNode = $node->is_last()?$node:$this->currentNode;

        foreach ($this->entitiesLink as $entityLink) {
            foreach ($userNode->views as $view) {;
                if ($entityLink->entity_id == $view->entity_id) {
                    if ($view->checkRole()) {
                        $entityModel = Yii::$app->modules[Config::MODULE_NAME]->entityFactory->getInstanceModelByView($entityLink->entity_item_id, $entityLink->entity_id, $view);
                        echo $view->getHtml($entityModel);
                    }
                }
            }
        }

//        if(!$node->is_last()) {
//            foreach ($this->entitiesLink as $entityLink) {
//                foreach ($this->currentNode->views as $view) {;
//                    if ($entityLink->entity_id == $view->entity_id) {
//                        if ($view->checkRole()) {
//                            $entityModel = Yii::$app->modules[Config::MODULE_NAME]->entityFactory->getInstanceModelByView($entityLink->entity_item_id, $entityLink->entity_id, $view);
//                            echo $view->getHtml($entityModel);
//                        }
//                    }
//                }
//            }
//        }else{
//            foreach ($this->entitiesLink as $entityLink) {
//                foreach ($node->views as $view) {
//                    if ($entityLink->entity_id == $view->entity_id) {
//                        if ($view->checkRole()) {
//                            $entityModel = Yii::$app->modules[Config::MODULE_NAME]->entityFactory->getInstanceModelByView($entityLink->entity_item_id, $entityLink->entity_id, $view);
//                            echo $view->getHtml($entityModel);
//                        }
//                    }
//                }
//            }
//
//        }
    }

    public function getFiles()
    {
        return $this->hasMany(TasksFiles::className(), ['task_id' => 'id']);
    }

    public function getFilesAdp()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => $this->getFiles(),
        ]);

        return $dataProvider;
    }

    public function renderFiles()
    {
        $html = '<div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Прикрепленные файлы</h3>
                    </div>';
        $html .= GridView::widget([
            'dataProvider' => $this->getFilesAdp(),
            'showHeader' => false,
            'summary' => '',
            'tableOptions' => [
                'style' => 'margin-bottom: 0;',
                'class' => 'table table-striped',
            ],
            'columns' => [
                [
                    'format' => 'html',
                    'value' => function($model){
                        $path = Yii::$app->getUrlManager()->createAbsoluteUrl($model->urlPath);
                        return Html::a( $model->name, $path, ['title' => Yii::t('yii', $model->name)]);
                    }
                ],

            ],
        ]);
        $html .= '</div>';

        return $html;
    }
}
