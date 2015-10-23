<?php

namespace common\modules\entity\common\models;

//use backend\models\User;
use common\modules\entity\common\factories\EntityTypeViewClassGenerationFactory;
use common\modules\entity\common\helpers\SystemFieldsHelper;
use common\modules\entity\common\models\permission\User;
use common\helpers\DebugHelper;
use common\modules\entity\common\config\Config;
use Yii;
use yii\data\ActiveDataProvider;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\widgets\DetailView;
use common\modules\entity\common\factories\EntityTypeViewClassFactory;
use yii\web\NotFoundHttpException;

/**
 * This is the model class for table "entity_views".
 *
 * @property integer $id
 * @property integer $entity_id
 * @property string $title
 * @property string $code
 * @property string $html
 *
 * @property EntityTypes $entity
 * @property EntityViewsLang[] $entityViewsLangs
 * @property ViewsRules[] $viewsRules
 */
class EntityViews extends \yii\db\ActiveRecord
{
    protected $arRenderedViews = [];
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'entity_views';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('sdb');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'code'], 'required'],
            [['entity_id', 'parent_view_id', 'foreign_key_field_id'], 'integer'],
            [['title', 'code', 'html', 'settings'], 'string'],
            [['code'], 'unique'],
            [['title'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'entity_id' => Yii::t('app', 'Объект'),
            'parent_view_id' => Yii::t('app', 'Родительское представление'),
            'foreign_key_field_id' => Yii::t('app', 'Внешний ключ к родительскому представлению'),
            'title' => Yii::t('app', 'Наименования'),
            'code' => Yii::t('app', 'Код'),
            'html' => Yii::t('app', 'Html'),
            'settings' => Yii::t('app', 'Настройки'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParentViews()
    {
        return $this->hasMany(EntityViews::className(), ['id' => 'parent_view_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParentView()
    {
        return $this->hasOne(EntityViews::className(), ['id' => 'parent_view_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getChildViews()
    {
        return $this->hasMany(EntityViews::className(), ['parent_view_id' => 'id']);
    }

    public function getChildViewsAdp()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => $this->getChildViews(),
        ]);

        return $dataProvider;
    }

    public function getForeignKeyField()
    {
        return $this->hasOne(EntityFields::className(), ['id' => 'foreign_key_field_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEntity()
    {
        return $this->hasOne(EntityTypes::className(), ['id' => 'entity_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLangs()
    {
        return $this->hasMany(EntityViewsLang::className(), ['main' => 'id']);
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function getLangsAdp()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => $this->getLangs(),
        ]);

        return $dataProvider;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRules()
    {
        return $this->hasMany(ViewsRules::className(), ['view_id' => 'id']);
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function getRulesAdp()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => $this->getRules(),
        ]);

        return $dataProvider;
    }

    public function getFields() {
        return $this->hasMany(EntityFields::className(), ['id' => 'field_id'])
            ->via('rules');
    }

    protected function getFieldsCodesArray($entityModel)
    {
        $fieldsCodes = [];
        foreach($this->fields as $field){
            if(!empty($entityModel->{$field->code})) {
                if (empty($field->dictionary_id)) {
                    $fieldsCodes[] = $field->code;
                } else {
                    $fieldsCodes[] = [
                        'attribute' => $field->code,
                        'format' => 'html',
                        'value' => $field->getDictionaryValue($field->dictionary_id, $entityModel->{$field->code}),
                    ];
                }
            }
        }
        return $fieldsCodes;
    }

    public function getHtml($entityModel)
    {
        $html = $this->html;
        if(!empty($html)) {
            foreach ($this->fields as $field) {
                $html = str_replace('<%' . $field->code . '%>', $field->getView($entityModel), $html);
            }
        }else{
            if(empty($this->childViews)) {


                if($this->getSetting('view-type') == 'table'){
                    if(!in_array($this->code, $this->arRenderedViews)) {
                        $html = '<div class="panel panel-default box2">
                                <div class="panel-heading">
                                    <h3 class="panel-title">' . $this->title . '</h3>
                                </div>';
                        $html .= GridView::widget([
                            'summary' => '',
                            'dataProvider' => $entityModel->searchByTaskId(Yii::$app->request->get('task_id')),
                            'columns' => $this->columnsForGridView,
                            'tableOptions' => [
                                'class' => 'table table-striped',
                                'style' => 'margin-bottom: 0px;'
                            ]
                        ]);
                        $html .= '</div>';
                        $this->arRenderedViews[] = $this->code;
                    }
                }else {
                    $html = '<div class="panel panel-default box2">
                                <div class="panel-heading">
                                    <h3 class="panel-title">' . $this->title . '</h3>
                                </div>';
                    $html .= DetailView::widget([
                        'model' => $entityModel,
                        'attributes' => $this->getFieldsCodesArray($entityModel),
                    ]);
                    $html .= '</div>';
                }


            }else{
                $html = '';

                foreach($this->childViews as $childView){
                    $html .= '<div class="panel panel-default box2">
                                <div class="panel-heading">
                                    <h3 class="panel-title">' . $childView->title . '</h3>
                                </div>';
                    $childEntity = $childView->getChildEntity($entityModel);
                    $html .= GridView::widget([
                        'summary' => '',
                        'dataProvider' => $childEntity->search(),
                        'columns' => $childView->columnsForGridView,
                        'tableOptions' => [
                            'class' => 'table table-striped',
                            'style' => 'margin-bottom: 0px;'
                        ]
                    ]);
                    $html .= '</div>';
                }
            }
        }

        return $html;
    }

    public function getChildEntity($parentEntity)
    {
        $entity = EntityTypeViewClassFactory::get($this->id);
        $entity->{$this->foreignKeyField->code} = $parentEntity->id;

        return $entity;
    }

    public function getEntityItemByLink($entityItemLink)
    {
        $entityType = EntityTypeViewClassFactory::get($this->id);
        if (($itemModel = $entityType::findOne($entityItemLink->entity_item_id)) !== null) {
            return $itemModel;
        } else {
            throw new NotFoundHttpException('The requested entity item does not exist.');
        }
    }

    public function getColumnsForGridView()
    {
        $columns = [];
        foreach($this->rules as $rule)
        {
            if($rule->field->id != $this->foreign_key_field_id
                && $rule->field->code != SystemFieldsHelper::SYSTEM_TASK_ID
                && $rule->field->code != SystemFieldsHelper::SYSTEM_NEXT_NODE_ID) {
                if (empty($rule->field->dictionary_id)) {
                    $columns[] = $rule->field->code;
                } else {
                    $columns[] = [
                        'attribute' => $rule->field->code,
                        'format' => 'html',
                        'value' => function($model) use ($rule) {
                            return $rule->field->getDictionaryValue($rule->field->dictionary_id, $model->{$rule->field->code});

                        },
                    ];
                }
            }
        }

        return $columns;
    }

    public function getRoles()
    {
        return $this->hasMany(NodeViewRoleLink::className(), ['view_id' => 'id']);
    }

    public function checkRole()
    {
        $user = User::findOne(Yii::$app->user->id);
        if(!empty($user)) {
            foreach ($this->roles as $role) {
                foreach ($user->roles as $userRole) {
                    if ($role->role_id == $userRole->id) {
                        return true;
                    }
                }
            }
        }

        return false;
    }

    public function getAllEntityFields()
    {
        return ArrayHelper::map($this->entity->fields, 'id', 'title');
    }

    public function getAllViews()
    {
        return ArrayHelper::map(EntityViews::find()->where(['not in','id',[$this->id]])->all(), 'id', 'title');
    }

    public function getSetting($settingsName)
    {
        $settings = json_decode($this->settings, true);
        if(is_array($settings) && !empty($settings)){
            if(isset($settings[$settingsName])){
                return $settings[$settingsName];
            }
        }

        return false;
    }
}
