<?php

namespace common\modules\executor\models;

use Yii;

/**
 * This is the model class for table "roles".
 *
 * @property integer $id
 * @property string $title
 * @property string $code
 *
 * @property NodeActionRoleLink[] $nodeActionRoleLinks
 * @property NodeViewRoleLink[] $nodeViewRoleLinks
 * @property RightRoleLink[] $rightRoleLinks
 */
class Roles extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'roles';
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
    public function getNodeActionRoleLinks()
    {
        return $this->hasMany(NodeActionRoleLink::className(), ['role_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNodeViewRoleLinks()
    {
        return $this->hasMany(NodeViewRoleLink::className(), ['role_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRightRoleLinks()
    {
        return $this->hasMany(RightRoleLink::className(), ['role_id' => 'id']);
    }

    public function getRights()
    {
        $this->hasMany(Rights::className(), ['id' => 'right_id'])
            ->via("rightRoleLinks");
    }
}
