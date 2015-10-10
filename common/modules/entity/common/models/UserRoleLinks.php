<?php

namespace common\modules\entity\common\models;

use Yii;
use common\modules\entity\common\models\Roles;
use yii\helpers\ArrayHelper;

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
            'user_id' => Yii::t('app', 'Пользователь'),
            'role_id' => Yii::t('app', 'Роль'),
        ];
    }

    public function getAllRoles()
    {
        return ArrayHelper::map(Roles::find()->all(), 'id', 'title');
    }

    public function getRole()
    {
        return $this->hasOne(Roles::className(),['id' => 'role_id']);
    }

    public function getUser()
    {
        return $this->hasOne(User::className(),['id' => 'user_id']);
    }
}
