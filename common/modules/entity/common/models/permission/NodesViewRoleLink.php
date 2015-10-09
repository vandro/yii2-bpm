<?php

namespace common\modules\entity\common\models\permission;

use Yii;

/**
 * This is the model class for table "node_view_role_link".
 *
 * @property integer $id
 * @property integer $node_id
 * @property integer $view_id
 * @property integer $role_id
 *
 * @property Roles $role
 * @property EntityViews $view
 * @property ProcessNodes $node
 */
class NodesViewRoleLink extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'node_view_role_link';
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
            [['node_id', 'view_id', 'role_id'], 'required'],
            [['node_id', 'view_id', 'role_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'node_id' => Yii::t('app', 'Шаг'),
            'view_id' => Yii::t('app', 'Представление'),
            'role_id' => Yii::t('app', 'Роль'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRole()
    {
        return $this->hasOne(Roles::className(), ['id' => 'role_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getView()
    {
        return $this->hasOne(EntityViews::className(), ['id' => 'view_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNode()
    {
        return $this->hasOne(Nodes::className(), ['id' => 'node_id']);
    }

    /**
     * @inheritdoc
     * @return NodesViewRoleLinkQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new NodesViewRoleLinkQuery(get_called_class());
    }
}
