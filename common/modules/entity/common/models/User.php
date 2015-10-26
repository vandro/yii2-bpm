<?php

namespace common\modules\entity\common\models;

use common\modules\entity\common\models\Roles;
use Yii;
use yii\helpers\ArrayHelper;
use yii\data\ActiveDataProvider;
use common\modules\entity\common\models\permission\UserOrganDepartLink;

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
            [['username', 'email', 'password_hash', 'password_reset_token', 'account_activation_token', 'first_name', 'last_name'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['username'], 'unique'],
            [['email'], 'unique'],
            //[['password_reset_token'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'department_id' => Yii::t('app', 'Отдел'),
            'organisation_id' => Yii::t('app', 'Организация'),
            'first_name' => Yii::t('app', 'Имя'),
            'last_name' => Yii::t('app', 'Фамилия'),
            'username' => Yii::t('app', 'Логин'),
            'email' => Yii::t('app', 'Эл. адрес'),
            'password_hash' => Yii::t('app', 'Хэш пароля'),
            'status' => Yii::t('app', 'Статус'),
            'role' => Yii::t('app', 'Роль'),
            'auth_key' => Yii::t('app', 'Авт ключ'),
            'password_reset_token' => Yii::t('app', 'Токен восстановления пароля'),
            'account_activation_token' => Yii::t('app', 'Токен активизация учетной записи'),
            'created_at' => Yii::t('app', 'Дата добавлено'),
            'updated_at' => Yii::t('app', 'Дата обновлено'),
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
     * Creates data provider instance with search query applied
     *
     * @return ActiveDataProvider
     */
    public function getRoleLinksAdp()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => $this->getRoleLinks(),
        ]);

        return $dataProvider;
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
     * Creates data provider instance with search query applied
     *
     * @return ActiveDataProvider
     */
    public function getRolesAdp()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => $this->getRoles(),
        ]);

        return $dataProvider;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRoleModel()
    {
        return $this->hasOne(Roles::className(), ['id' => 'role']);
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

    public function getAllRoles()
    {
        return ArrayHelper::map(Roles::find()->all(), 'id', 'title');
    }

    public function getAllOrganizations()
    {
        return ArrayHelper::map(Organizations::find()->all(), 'id', 'title');
    }

    public function getAllDepartments()
    {
        return !empty($this->organisation_id)?ArrayHelper::map(Departments::find()->where(['organisation_id' => $this->organisation_id])->all(), 'id', 'title'):[];
    }

    public function getOrganizationDepartments()
    {
        return $this->hasMany(UserOrganDepartLink::className(), ['user_id' => 'id']);
    }

    public function getOrganizationDepartmentsAdp()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => $this->getOrganizationDepartments(),
        ]);

        return $dataProvider;
    }
}
