<?php

namespace common\modules\entity\common\models;

use Yii;

/**
 * This is the model class for table "views_rules".
 *
 * @property integer $id
 * @property integer $view_id
 * @property integer $field_id
 * @property string $code
 * @property string $value
 *
 * @property EntityFields $field
 * @property EntityViews $view
 */
class ViewsRules extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'views_rules';
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
            [['view_id', 'field_id', 'code'], 'required'],
            [['view_id', 'field_id'], 'integer'],
            [['code', 'value'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'view_id' => Yii::t('app', 'View ID'),
            'field_id' => Yii::t('app', 'Field ID'),
            'code' => Yii::t('app', 'Code'),
            'value' => Yii::t('app', 'Value'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getField()
    {
        return $this->hasOne(EntityFields::className(), ['id' => 'field_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getView()
    {
        return $this->hasOne(EntityViews::className(), ['id' => 'view_id']);
    }
}
