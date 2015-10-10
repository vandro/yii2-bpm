<?php

namespace common\modules\epigu\models;

use common\modules\entity\common\models\EntityTypes;
use Yii;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "epigu_service".
 *
 * @property integer $id
 * @property integer $epugi_id
 * @property string $title
 * @property string $code
 *
 * @property EpiguAndEntityFieldsLink[] $epiguAndEntityFieldsLinks
 * @property EpiguServiceFileds[] $epiguServiceFileds
 */
class EpiguService extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'epigu_service';
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
            [['epugi_id', 'title', 'code'], 'required'],
            [['epugi_id'], 'integer'],
            [['title', 'code'], 'string'],
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
            'epugi_id' => Yii::t('app', 'Epugi ID'),
            'title' => Yii::t('app', 'Title'),
            'code' => Yii::t('app', 'Code'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEpiguAndEntityFieldsLinks()
    {
        return $this->hasMany(EpiguAndEntityFieldsLink::className(), ['epigu_service_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEpiguServiceFileds()
    {
        return $this->hasMany(EpiguServiceFileds::className(), ['epigu_service_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFields()
    {
        return $this->hasMany(EpiguServiceFileds::className(), ['epigu_service_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNotInEpiguFields($entity_type_id)
    {
        $entityType = EntityTypes::findOne($entity_type_id);
        $fieldNames = [];
        foreach($entityType->fields as $field){
            $fieldNames[] = $field->code;
        }

//        return $entityType->getFields()->where(['not in','code', $fieldNames]);
        return $this->getFields()->where(['not in','name', $fieldNames]);
    }

    public function getNotInEntityFieldsAdp($entity_type_id)
    {
        $dataProvider = new ActiveDataProvider([
            'query' => $this->getNotInEpiguFields($entity_type_id),
            'pagination' => [
                'pageSize' => 1000,
            ],
        ]);

        return $dataProvider;
    }

    /**
     * @inheritdoc
     * @return EpiguServiceQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new EpiguServiceQuery(get_called_class());
    }

    public function getFieldsAdp()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => $this->getEpiguServiceFileds(),
        ]);

        return $dataProvider;
    }

    public function getAllFields($entityType)
    {
        $names = [];
        foreach($entityType->fields as $field){
            $names[] = $field->code;
        }
        $epiguServiceFields = $this->hasMany(EpiguServiceFileds::className(), ['epigu_service_id' => 'id'])
            ->where(['not in', 'name', $names])
            ->all();
        return ArrayHelper::map($epiguServiceFields, 'id', 'label_ru');
    }
}
