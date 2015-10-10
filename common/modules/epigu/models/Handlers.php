<?php

namespace common\modules\epigu\models;

use Yii;

/**
 * This is the model class for table "handlers".
 *
 * @property integer $id
 * @property string $title
 * @property string $code
 * @property string $class
 *
 * @property ActionHandlerLink[] $actionHandlerLinks
 */
class Handlers extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'handlers';
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
            [['title'], 'required'],
            [['title', 'code', 'class'], 'string'],
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
            'title' => Yii::t('app', 'Наименования'),
            'code' => Yii::t('app', 'Код'),
            'class' => Yii::t('app', 'Класс'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getActionHandlerLinks()
    {
        return $this->hasMany(ActionHandlerLink::className(), ['handler_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return HandlersQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new HandlersQuery(get_called_class());
    }
}
