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
            'epigu_service_id' => Yii::t('app', 'Епигу сервис'),
            'epigu_fileld_id' => Yii::t('app', 'Епигу поля'),
            'name' => Yii::t('app', 'Имя'),
            'group' => Yii::t('app', 'Группа'),
            'label_ru' => Yii::t('app', 'Метка Ru'),
            'label_uz' => Yii::t('app', 'Метка Uz'),
            'label_en' => Yii::t('app', 'Метка En'),
            'description_ru' => Yii::t('app', 'Описание Ru'),
            'description_uz' => Yii::t('app', 'Описание Uz'),
            'description_en' => Yii::t('app', 'Описание En'),
            'has_group' => Yii::t('app', 'Группа'),
            'type' => Yii::t('app', 'Тип'),
            'depend' => Yii::t('app', 'Зависеть'),
            'has_dependents' => Yii::t('app', 'Зависимые'),
            'is_default' => Yii::t('app', 'По умолчанию'),
            'disabled' => Yii::t('app', 'Отключено'),
            'defaultValue' => Yii::t('app', 'Значение по умолчанию'),
            'api' => Yii::t('app', 'Апи'),
            'validators' => Yii::t('app', 'Валидаторы'),
            'step' => Yii::t('app', 'Шаг'),
            'mode' => Yii::t('app', 'Режим'),
            'inResult' => Yii::t('app', 'Результать'),
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
}
