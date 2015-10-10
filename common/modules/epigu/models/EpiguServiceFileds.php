<?php

namespace common\modules\epigu\models;

use Yii;

/**
 * This is the model class for table "epigu_service_fileds".
 *
 * @property integer $id
 * @property integer $epigu_service_id
 * @property integer $epigu_fileld_id
 * @property string $name
 * @property string $group
 * @property string $label_ru
 * @property string $label_uz
 * @property string $label_en
 * @property string $description_ru
 * @property string $description_uz
 * @property string $description_en
 * @property integer $has_group
 * @property string $type
 * @property string $depend
 * @property integer $has_dependents
 * @property integer $is_default
 * @property integer $disabled
 * @property string $defaultValue
 * @property string $api
 * @property string $validators
 * @property integer $step
 * @property string $mode
 * @property integer $inResult
 *
 * @property EpiguAndEntityFieldsLink[] $epiguAndEntityFieldsLinks
 * @property EpiguService $epiguService
 */
class EpiguServiceFileds extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'epigu_service_fileds';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('edb');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['epigu_service_id', 'name'], 'required'],
            [['epigu_service_id', 'epigu_fileld_id', 'has_group', 'has_dependents', 'is_default', 'disabled', 'step', 'inResult'], 'integer'],
            [['name', 'group', 'label_ru', 'label_uz', 'label_en', 'description_ru', 'description_uz', 'description_en', 'type', 'depend', 'defaultValue', 'api', 'validators', 'mode'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'epigu_service_id' => Yii::t('app', 'Epigu Service ID'),
            'epigu_fileld_id' => Yii::t('app', 'Epigu Fileld ID'),
            'name' => Yii::t('app', 'Name'),
            'group' => Yii::t('app', 'Group'),
            'label_ru' => Yii::t('app', 'Label Ru'),
            'label_uz' => Yii::t('app', 'Label Uz'),
            'label_en' => Yii::t('app', 'Label En'),
            'description_ru' => Yii::t('app', 'Description Ru'),
            'description_uz' => Yii::t('app', 'Description Uz'),
            'description_en' => Yii::t('app', 'Description En'),
            'has_group' => Yii::t('app', 'Has Group'),
            'type' => Yii::t('app', 'Type'),
            'depend' => Yii::t('app', 'Depend'),
            'has_dependents' => Yii::t('app', 'Has Dependents'),
            'is_default' => Yii::t('app', 'Is Default'),
            'disabled' => Yii::t('app', 'Disabled'),
            'defaultValue' => Yii::t('app', 'Default Value'),
            'api' => Yii::t('app', 'Api'),
            'validators' => Yii::t('app', 'Validators'),
            'step' => Yii::t('app', 'Step'),
            'mode' => Yii::t('app', 'Mode'),
            'inResult' => Yii::t('app', 'In Result'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEpiguAndEntityFieldsLinks()
    {
        return $this->hasMany(EpiguAndEntityFieldsLink::className(), ['epigu_service_field_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEpiguService()
    {
        return $this->hasOne(EpiguService::className(), ['id' => 'epigu_service_id']);
    }

    /**
     * @inheritdoc
     * @return EpiguServiceFiledsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new EpiguServiceFiledsQuery(get_called_class());
    }

    public function getEntityFieldType()
    {
        $types = [
            'radiobuttonlist' => 'INT',
            'checkbox' => 'INT',
            'select' => 'INT',
            'text' => 'VARCHAR',
            'textarea' => 'TEXT',
        ];

        return $types[$this->type];
    }

    public function getEntityFieldLength()
    {
        $lengths = [
            'radiobuttonlist' => 6,
            'checkbox' => 6,
            'select' => 6,
            'text' => 255,
            'textarea' => 800,
        ];

        return $lengths[$this->type];
    }
}
