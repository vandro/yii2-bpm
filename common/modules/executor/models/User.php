<?php

namespace common\modules\executor\models;

use common\helpers\DebugHelper;
use Yii;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property integer $organisation_id
 * @property integer $department_id
 * @property string $username
 * @property string $email
 * @property string $password_hash
 * @property integer $status
 * @property integer $role
 * @property string $auth_key
 * @property string $password_reset_token
 * @property string $account_activation_token
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property Article[] $articles
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['organisation_id', 'department_id', 'status', 'role', 'created_at', 'updated_at'], 'integer'],
            [['username', 'email', 'password_hash', 'status', 'auth_key', 'created_at', 'updated_at'], 'required'],
            [['username', 'email', 'password_hash', 'password_reset_token', 'account_activation_token', 'last_name','first_name'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['username'], 'unique'],
            [['email'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'organisation_id' => Yii::t('app', 'Organisation ID'),
            'department_id' => Yii::t('app', 'Department ID'),
            'first_name' => Yii::t('app', 'Имя'),
            'last_name' => Yii::t('app', 'Фамилия'),
            'username' => Yii::t('app', 'Логин'),
            'email' => Yii::t('app', 'Email'),
            'password_hash' => Yii::t('app', 'Password Hash'),
            'status' => Yii::t('app', 'Status'),
            'role' => Yii::t('app', 'Role'),
            'auth_key' => Yii::t('app', 'Auth Key'),
            'password_reset_token' => Yii::t('app', 'Password Reset Token'),
            'account_activation_token' => Yii::t('app', 'Account Activation Token'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserOrganDepartLink()
    {
        return $this->hasMany(UserOrganDepartLink::className(), ['user_id' => 'id']);
    }

    public function getUserRoleLink()
    {
        return $this->hasMany(UserRoleLink::className(), ['user_id' => 'id']);
    }

    public function getRoles()
    {
        return $this->hasMany(Roles::className(), ['id' => 'role_id'])
            ->via('userRoleLink');
    }

    public function hasOrganisationRight()
    {
        foreach($this->roles as $role){
            if(!empty($role->rightRoleLinks)) {
                foreach ($role->rightRoleLinks as $link) {
                    if ($link->right->code == 'organization' || $link->right->code == 'organizations') {
                        return true;
                    }
                }
            }
        }

        return false;
    }

    public function getTitle()
    {
        $title = '';
        if(!empty($this->first_name)) $title .= $this->first_name." ";
        if(!empty($this->first_name)) $title .= $this->last_name." ";
        $title .= "(".$this->username.")";
        return $title;
    }
}
