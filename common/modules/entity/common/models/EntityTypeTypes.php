<?php

namespace common\modules\entity\common\models;

use Yii;

/**
 * This is the model class for table "entity_type_types".
 *
 * @property integer $id
 * @property string $title
 * @property string $code
 *
 * @property EntityTypes[] $entityTypes
 */
class EntityTypeTypes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'entity_type_types';
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
            'title' => Yii::t('app', 'Title'),
            'code' => Yii::t('app', 'Code'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEntityTypes()
    {
        return $this->hasMany(EntityTypes::className(), ['type' => 'id']);
    }

    /**
     * @inheritdoc
     * @return EntityTypeTypesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new EntityTypeTypesQuery(get_called_class());
    }
}
