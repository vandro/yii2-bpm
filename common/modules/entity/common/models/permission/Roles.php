<?php

namespace common\modules\entity\common\models\permission;

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
            'title' => Yii::t('app', 'Наименования'),
            'code' => Yii::t('app', 'Код'),
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
    public function getActionNodes()
    {
        return $this->hasMany(Nodes::className(), ['id' => 'node_id'])
            ->via('nodeActionRoleLinks');
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
    public function getViewNodes()
    {
        return $this->hasMany(Nodes::className(), ['id' => 'node_id'])
            ->via('nodeViewRoleLinks');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRightRoleLinks()
    {
        return $this->hasMany(RightRoleLink::className(), ['role_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return RolesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new RolesQuery(get_called_class());
    }
}
