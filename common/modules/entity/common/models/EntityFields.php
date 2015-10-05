<?php

namespace common\modules\entity\common\models;

use common\helpers\DebugHelper;
use Yii;
use yii\data\ActiveDataProvider;
use common\modules\entity\common\config\Config;

/**
 * This is the model class for table "entity_fields".
 *
 * @property integer $id
 * @property integer $entity_id
 * @property string $title
 * @property string $code
 * @property string $type
 * @property integer $length
 * @property integer $dictionary_id
 * @property string $options
 * @property integer $added
 *
 * @property EntityTypes $dictionary
 * @property EntityTypes $entity
 * @property EntityFildsLang[] $entityFildsLangs
 * @property FormsRules[] $formsRules
 * @property ViewsRules[] $viewsRules
 */
class EntityFields extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'entity_fields';
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
            [['title', 'code', 'type'], 'required'],
            [['entity_id', 'length', 'dictionary_id','added'], 'integer'],
            [['title', 'code', 'type', 'options'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'entity_id' => Yii::t('app', 'Entity ID'),
            'title' => Yii::t('app', 'Title'),
            'code' => Yii::t('app', 'Code'),
            'type' => Yii::t('app', 'Type'),
            'length' => Yii::t('app', 'Length'),
            'dictionary_id' => Yii::t('app', 'Dictionary ID'),
            'options' => Yii::t('app', 'Options'),
            'added' => Yii::t('app', 'Added'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDictionary()
    {
        return $this->hasOne(EntityTypes::className(), ['id' => 'dictionary_id']);
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
        return $this->hasMany(EntityFieldsLang::className(), ['main' => 'id']);
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
    public function getFormsRules()
    {
        return $this->hasMany(FormsRules::className(), ['field_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getViewsRules()
    {
        return $this->hasMany(ViewsRules::className(), ['field_id' => 'id']);
    }

    public function getWidget($entity, $activeForm, $form)
    {
        return Yii::$app->modules[Config::MODULE_NAME]->widgetFactory->get($this,$entity, $activeForm, $form);
    }

    public function getDictionaryValue($entity_id, $value)
    {
        $options = json_decode($this->options, true);
        $entity = Yii::$app->modules[Config::MODULE_NAME]->entityFactory->getInstanceById($entity_id);
        $model = $entity::findOne($value);
        if(!empty($model)) {
            return $model->{$options['value']};
        }else{
            return 'Нет значения';
        }

    }
}
