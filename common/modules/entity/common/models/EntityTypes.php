<?php

namespace common\modules\entity\common\models;

use common\helpers\DebugHelper;
use common\modules\entity\common\actions\FilteredFieldApiAction;
use common\modules\entity\common\factories\EntityTypeClassFactory;
use Yii;
use yii\data\ActiveDataProvider;
use yii\db\Query;
use common\modules\entity\common\config\Config;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

/**
 * This is the model class for table "entity_types".
 *
 * @property integer $id
 * @property string $title
 * @property string $code
 * @property integer $added
 * @property integer $database_id
 *
 * @property EntityFields[] $entityFields
 * @property EntityFields[] $entityFields0
 * @property EntityFildsLang[] $entityFildsLangs
 * @property EntityForms[] $entityForms
 * @property EntityFormsLang[] $entityFormsLangs
 * @property EntityTypesLang[] $entityTypesLangs
 * @property EntityViews[] $entityViews
 * @property EntityViewsLang[] $entityViewsLangs
 * @property FormsRules[] $formsRules
 * @property ViewsRules[] $viewsRules
 */
class EntityTypes extends \yii\db\ActiveRecord
{
    protected $_activeRecord;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'entity_types';
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
            [['title', 'code'], 'string'],
            [['added', 'database_id', 'type_id', 'published'], 'integer'],
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
            'title' => 'Наименования',
            'code' => 'Код',
            'added' => 'Добавленной',
            'database_id' => 'База данных',
            'type_id' => 'Тип сущности',
            'published' => 'Опубликован',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFields()
    {
        return $this->hasMany(EntityFields::className(), ['entity_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDatabase()
    {
        return $this->hasOne(Databeses::className(), ['id' => 'database_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getType()
    {
        return $this->hasOne(EntityTypeTypes::className(), ['id' => 'type_id']);
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function getFieldsAdp()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => $this->getFields(),
        ]);

        return $dataProvider;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getForms()
    {
        return $this->hasMany(EntityForms::className(), ['entity_id' => 'id']);
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function getFormsAdp()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => $this->getForms(),
        ]);

        return $dataProvider;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLangs()
    {
        return $this->hasMany(EntityTypesLang::className(), ['main' => 'id']);
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
    public function getViews()
    {
        return $this->hasMany(EntityViews::className(), ['entity_id' => 'id']);
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function getViewsAdp()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => $this->getViews(),
        ]);

        return $dataProvider;
    }

    public function getItemFieldsForGridView()
    {
        $fields = [];

        foreach($this->fields as $field){
            //if(empty($field->dictionary_id)) {
                //if($field->visible) {
                    $fields[] = $field->code;
                //}
//            }else{
//                //if($field->visible) {
//                    $dictionary = Dictionary::findOne($field->dictionary_id);
//                    $code = $field->code;
//                    $fields[] = [
//                        'attribute' => $dictionary->title,
//                        'format' => 'raw',
//                        'value' => function ($data) use ($code, $dictionary) {
//                            $dictionaryItemModel = DictionaryItemFactory::getInstance($dictionary);
//                            $element = $dictionaryItemModel::findOne($data->{$code});
//                            if(!empty($element)) {
//                                return $element->title;
//                            }
//                        },
//                    ];
//                //}
//            }
        }

        return $fields;
    }

    public function getItemFieldsForDetailView($itemModel)
    {
        $fields = [];

        foreach($this->fields as $field){
//            if(empty($field->dictionary_id)) {
                $fields[] = $field->code;
//            }else{
//                $code = $field->code;
//                $dictionary = Dictionary::findOne($field->dictionary_id);
//                $dictionaryItemModel = DictionaryItemFactory::getInstance($dictionary);
//                $fields[] = [
//                    'label' => $dictionary->title,
//                    'format' => 'raw',
//                    'value' => $dictionaryItemModel::findOne($itemModel->$code)->title
//                ];
//            }
        }

        return $fields;
    }

    public function getItemSearchModel()
    {
        return Yii::$app->modules[Config::BACKEND_MODULE_NAME]->entityFactory->getInstance($this);
    }

    public function getItemSearchModelForFrontend()
    {
        return Yii::$app->modules[Config::MODULE_NAME]->entityFactory->getInstance($this);
    }

    public function getSelectData($field, $entity)
    {
        $options = json_decode($field->options, true);
        $entityModel = $this->getItemSearchModelForFrontend();
        if(isset($options['dependFrom'])){
            $values = FilteredFieldApiAction::getDependFromData($field, $entity, $this);
        }else{
            $values = $entityModel::find()->all();
        }

        return ArrayHelper::map($values,$options['key'], $options['value']);
    }

    public function getAllFields()
    {
        return ArrayHelper::map($this->fields, 'id', 'title');
    }

    /**
     * @return mixed
     */
    public function getModel()
    {
        if(empty($this->_activeRecord)){
            $this->_activeRecord = EntityTypeClassFactory::get($this->id);
        }
        return $this->_activeRecord;
    }

    public function getFieldsForGridView()
    {
        $columns = [];
        $columns[] = [
            'class' => 'yii\grid\ActionColumn',
            'template'=>'{select}',
            'buttons'=>[
                'select'=>function ($url, $model) {
                    return Html::a( '<span class="glyphicon glyphicon-arrow-left"></span>', '#',
                        [
                            'title' => Yii::t('yii', 'Выбрать'),
                            'data-pjax' => 0,
                            'onclick' => 'selectElement('.$model->id.')',
                        ]);
                },
            ],
        ];
        foreach($this->fields as $fields) {
            $columns[] = $fields->code;
        }
        return $columns;
    }

    public function getForm()
    {
        return $this->forms[0];
    }

    public function getAllDatabases()
    {
        return ArrayHelper::map(Databeses::find()->all(), 'id', 'titleForDD');
    }

    public function getAllTypes()
    {
        return ArrayHelper::map(EntityTypeTypes::find()->all(), 'id', 'title');
    }
}

?>
