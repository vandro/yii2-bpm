<?php

namespace common\modules\entity\common\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "forms_rules".
 *
 * @property integer $id
 * @property integer $form_id
 * @property integer $field_id
 * @property string $code
 * @property string $value
 *
 * @property EntityFields $field
 * @property EntityForms $form
 */
class FormsRules extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'forms_rules';
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
            [['form_id', 'field_id', 'code'], 'required'],
            [['form_id', 'field_id'], 'integer'],
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
            'form_id' => Yii::t('app', 'Таблица'),
            'field_id' => Yii::t('app', 'Поля'),
            'code' => Yii::t('app', 'Код'),
            'value' => Yii::t('app', 'Значение'),
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
    public function getForm()
    {
        return $this->hasOne(EntityForms::className(), ['id' => 'form_id']);
    }

    public function getAllFields($mode)
    {
        $fieldsIds = [];
        foreach($this->form->rules as $rule){
            if($this->field_id != $rule->field_id) {
                $fieldsIds[] = $rule->field_id;
            }
        }
        $fields = EntityFields::find()
            ->where(['entity_id' => $this->form->entity_id])
            ->andWhere(['not in','id', $fieldsIds])
            ->all();
        return ArrayHelper::map($fields, 'id','title');
    }
}
