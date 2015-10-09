<?php

namespace common\modules\entity\common\models;

use Yii;

/**
 * This is the model class for table "nodes_actions_lang".
 *
 * @property integer $id
 * @property integer $main
 * @property string $lang
 * @property string $title
 *
 * @property NodesActions $main0
 */
class NodesActionsLang extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'nodes_actions_lang';
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
            [['lang', 'title'], 'required'],
            [['main'], 'integer'],
            [['lang', 'title'], 'string'],
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
            'main' => Yii::t('app', 'Главный'),
            'lang' => Yii::t('app', 'Языки'),
            'title' => Yii::t('app', 'Наименования'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMain0()
    {
        return $this->hasOne(NodesActions::className(), ['id' => 'main']);
    }
}
