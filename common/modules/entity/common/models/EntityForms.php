<?php

namespace common\modules\entity\common\models;

use common\helpers\DebugHelper;
use common\modules\entity\common\config\Config;
use Yii;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use yii\widgets\DetailView;
use yii\grid\GridView;

/**
 * This is the model class for table "entity_forms".
 *
 * @property integer $id
 * @property integer $entity_id
 * @property string $title
 * @property string $code
 * @property string $html
 * @property string $widget
 * @property integer $added
 * @property string $mode
 *
 * @property EntityTypes $entity
 * @property EntityFormsLang[] $entityFormsLangs
 * @property FormsRules[] $formsRules
 */
class EntityForms extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'entity_forms';
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
            [['entity_id','added','parent_form_id', 'foreign_key_field_id'], 'integer'],
            [['title', 'code', 'html', 'widget', 'mode'], 'string'],
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
            'id' => 'ID',
            'entity_id' => 'Entity ID',
            'parent_form_id' => 'Parent Form ID',
            'foreign_key_field_id' => 'Foreign Key Field ID',
            'title' => 'Title',
            'code' => 'Code',
            'html' => 'Html',
            'mode' => 'Mode',
            'added' => 'Added',
        ];
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
        return $this->hasMany(EntityFormsLang::className(), ['main' => 'id']);
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
        return $this->hasMany(FormsRules::className(), ['form_id' => 'id']);
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

    public function render($activeForm, $entity)
    {
        if($this->mode != 'view') {
            $html = $this->html;

            foreach ($this->fields as $field) {
                $html = str_replace('{%' . $field->code . '%}', $field->getWidget($entity, $activeForm, $this), $html);
            }

            return $html;
        }else{
            $html = DetailView::widget([
                'model' => $entity,
                'attributes' => $this->columns,
            ]);

            foreach($this->childForms as $childForm){
                $html .= GridView::widget([
                    'dataProvider' => $childForm->getChildEntityAdp($entity),
                    'columns' => $childForm->columns,
                ]);
            }

            return $html;
        }
    }

    public function getChildEntityAdp($parentEntity)
    {
        $entity = Yii::$app->modules[Config::MODULE_NAME]->entityFactory->getByForm($this);
        $entity->{$this->foreignKeyField->code} = $parentEntity->id;

        return $entity->search();
    }

    public function getColumns()
    {
        $columns = [];
        foreach($this->fields as $field)
        {
            $columns[] = $field->code;
        }

        return $columns;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getActions()
    {
        return $this->hasMany(NodesActions::className(), ['form_id' => 'id']);
    }


    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function getActionsAdp()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => $this->getActions(),
        ]);

        return $dataProvider;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getChildForms()
    {
        return $this->hasMany(EntityForms::className(), ['parent_form_id' => 'id']);
    }

    public function getChildFormsAdp()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => $this->getChildForms(),
        ]);

        return $dataProvider;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParentForm()
    {
        return $this->hasOne(EntityForms::className(), ['id' => 'parent_form_id']);
    }

    public function getAllForms()
    {
        return ArrayHelper::map(EntityForms::find()->where(['not in','id',[$this->id]])->all(), 'id', 'title');
    }

    public function getAllEntityFields()
    {
        return ArrayHelper::map($this->entity->fields, 'id', 'title');
    }

    public function getForeignKeyField()
    {
        return $this->hasOne(EntityFields::className(), ['id' => 'foreign_key_field_id']);
    }
}
