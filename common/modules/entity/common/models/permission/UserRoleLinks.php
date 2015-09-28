<?php

namespace common\modules\entity\common\models\permission;

use Yii;

/**
 * This is the model class for table "user_role_link".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $role_id
 */
class UserRoleLinks extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_role_link';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'role_id'], 'required'],
            [['user_id', 'role_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'role_id' => Yii::t('app', 'Role ID'),
        ];
    }

    /**
     * @inheritdoc
     * @return UserRoleLinksQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UserRoleLinksQuery(get_called_class());
    }
}
