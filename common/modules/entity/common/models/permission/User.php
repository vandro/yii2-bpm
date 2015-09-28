<?php

namespace common\modules\entity\common\models\permission;

use common\helpers\DebugHelper;
use common\modules\entity\common\models\permission\NodeViewRoleLink;
use common\modules\entity\common\models\permission\Rights;
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
            [['username', 'email', 'password_hash', 'status', 'auth_key', 'created_at', 'updated_at'], 'required'],
            [['status', 'role', 'created_at', 'updated_at', 'organisation_id', 'department_id'], 'integer'],
            [['username', 'email', 'password_hash', 'password_reset_token', 'account_activation_token'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['username'], 'unique'],
            [['email'], 'unique'],
            [['password_reset_token'], 'unique']
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
            'username' => Yii::t('app', 'Username'),
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
    public function getRoleLinks()
    {
        return $this->hasMany(UserRoleLinks::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRoles()
    {
        return $this->hasMany(Roles::className(), ['id' => 'role_id'])
            ->via('roleLinks');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getViewNodes()
    {
        return NodesViewRoleLink::find()->in($this->roles)->all();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getViewActiveNodes()
    {
        return NodesViewRoleLink::find()->in($this->roles)->active()->all();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getViewInActiveNodes()
    {
        return NodesViewRoleLink::find()->notIn($this->roles)->active()->all();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getViewLastNodes()
    {
        return NodesViewRoleLink::find()->in($this->roles)->last()->all();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTasks()
    {
        return Tasks::find()->in($this->viewNodes)->rights()->all();
//        return Tasks::find()->in($this->viewNodes)->all();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getActiveTasks()
    {
        return Tasks::find()->in($this->viewActiveNodes)->rights()->all();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInactiveTasks()
    {
        return Tasks::find()->in($this->viewInActiveNodes)->rights()->all();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClosedTasks()
    {
        return Tasks::find()->in($this->viewLastNodes)->rights()->all();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRightRoleLinks()
    {
        return RightRoleLink::find()->in($this->roles)->all();
    }

    /**
     * @inheritdoc
     * @return UserQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UserQuery(get_called_class());
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrganisation()
    {
        return $this->hasOne(Organizations::className(), ['id' => 'organisation_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDepartment()
    {
        return $this->hasOne(Departments::className(), ['id' => 'department_id']);
    }

    public function hasRight($rightCode)
    {
        foreach($this->rightRoleLinks as $link){
            if($link->right->code == $rightCode){
                return true;
            }
        }

        return false;
    }

    public function hasActionAccess($acton, $node)
    {
        $roleIds = [];
        foreach($this->roles as $role){
            $roleIds[] = $role->id;
        }

        $links = NodesActionRoleLink::find()
            ->where([
                'node_id' => $node->id,
                'action_id' => $acton->id,
            ])
            ->andWhere(['in', 'role_id', $roleIds])
            ->all();

        if(!empty($links)){
            return true;
        }else{
            return false;
        }
    }

    public function hasViewAccess($node)
    {
        $roleIds = [];
        foreach($this->roles as $role){
            $roleIds[] = $role->id;
        }

        $links = NodesViewRoleLink::find()
            ->where([
                'node_id' => $node->id,
            ])
            ->andWhere(['in', 'role_id', $roleIds])
            ->all();

        if(!empty($links)){
            return true;
        }else{
            return false;
        }
    }

    public function getOrganizationDepartments()
    {
        return $this->hasMany(UserOrganDepartLink::className(), ['user_id' => 'id']);
    }

    public function getOrganizationsIds()
    {
        $itemIds = [];
        foreach($this->organizationDepartments as $item){
            $itemIds[] = $item->organization_id;
        }

        return $itemIds;
    }

    public function getDepartmentsIds()
    {
        $itemIds = [];
        foreach($this->organizationDepartments as $item){
            $itemIds[] = $item->deparment_id;
        }

        return $itemIds;
    }
}
