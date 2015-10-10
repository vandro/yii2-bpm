<?php

namespace common\modules\entity\common\models;

use common\modules\entity\common\models\permission\ProcessOrganDepartLink;
use Yii;
use yii\data\ActiveDataProvider;

/**
 * This is the model class for table "organizations".
 *
 * @property integer $id
 * @property string $title
 *
 * @property OrganizationsLang[] $organizationsLangs
 */
class Organizations extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'organizations';
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
            [['title'], 'required'],
            [['title'], 'string'],
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
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrganizationsLangs()
    {
        return $this->hasMany(OrganizationsLang::className(), ['main' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDepartments()
    {
        return $this->hasMany(Departments::className(), ['organisation_id' => 'id']);
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function getDepartmentsAdp()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => $this->getDepartments(),
        ]);

        return $dataProvider;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPods()
    {
        return $this->hasMany(ProcessOrganDepartLink::className(), ['organisation_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProcessLinks()
    {
        return $this->hasMany(ProcessOrganDepartLink::className(), ['organisation_id' => 'id']);
    }

    public function getProcessDepartmentsId($process_id)
    {
        foreach($this->processLinks as $link){
            if($process_id == $link->process_id){
                return $link->first_department_id;
            }
        }
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function getPodsAdp()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => $this->getPods(),
        ]);

        return $dataProvider;
    }
}
