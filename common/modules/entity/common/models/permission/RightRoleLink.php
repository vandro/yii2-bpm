<?php

namespace common\modules\entity\common\models\permission;

use Yii;

/**
 * This is the model class for table "right_role_link".
 *
 * @property integer $id
 * @property integer $right_id
 * @property integer $role_id
 *
 * @property Roles $role
 * @property Rights $right
 */
class RightRoleLink extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'right_role_link';
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
            [['right_id', 'role_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'right_id' => Yii::t('app', 'Right ID'),
            'role_id' => Yii::t('app', 'Role ID'),
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
    public function getRight()
    {
        return $this->hasOne(Rights::className(), ['id' => 'right_id']);
    }

    /**
     * @inheritdoc
     * @return RightRoleLinkQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new RightRoleLinkQuery(get_called_class());
    }
}
