<?php

namespace common\modules\entity\common\models;

use common\helpers\DebugHelper;
use Yii;
use yii\data\ActiveDataProvider;
use yii\db\Query;
use common\modules\entity\common\config\Config;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "entity_types".
 *
 * @property integer $id
 * @property string $title
 * @property string $code
 * @property integer $added
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
            [['added'], 'integer'],
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
            'title' => 'Title',
            'code' => 'Code',
            'added' => 'Added',
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

    public function getSelectData($field)
    {
        $options = json_decode($field->options, true);
        $entity = $this->getItemSearchModelForFrontend();
        return ArrayHelper::map($entity::find()->all(),$options['key'], $options['value']);
    }

    public function getAllFields()
    {
        return ArrayHelper::map($this->fields, 'id', 'title');
    }
}
