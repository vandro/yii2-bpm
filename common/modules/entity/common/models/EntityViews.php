<?php

namespace common\modules\entity\common\models;

//use backend\models\User;
use common\modules\entity\common\models\permission\User;
use common\helpers\DebugHelper;
use common\modules\entity\common\config\Config;
use Yii;
use yii\data\ActiveDataProvider;
use yii\widgets\DetailView;

/**
 * This is the model class for table "entity_views".
 *
 * @property integer $id
 * @property integer $entity_id
 * @property string $title
 * @property string $code
 * @property string $html
 *
 * @property EntityTypes $entity
 * @property EntityViewsLang[] $entityViewsLangs
 * @property ViewsRules[] $viewsRules
 */
class EntityViews extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'entity_views';
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
            [['entity_id'], 'integer'],
            [['title', 'code', 'html'], 'string'],
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
            'entity_id' => Yii::t('app', 'Объект'),
            'title' => Yii::t('app', 'Наименования'),
            'code' => Yii::t('app', 'Код'),
            'html' => Yii::t('app', 'Html'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEntity()
    {
        return $this->hasOne(EntityTypes::className(), ['id' => 'entity_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLangs()
    {
        return $this->hasMany(EntityViewsLang::className(), ['main' => 'id']);
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function getLangsAdp()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => $this->getLangs(),
        ]);

        return $dataProvider;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRules()
    {
        return $this->hasMany(ViewsRules::className(), ['view_id' => 'id']);
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function getRulesAdp()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => $this->getRules(),
        ]);

        return $dataProvider;
    }

    public function getFields() {
        return $this->hasMany(EntityFields::className(), ['id' => 'field_id'])
            ->via('rules');
    }

    protected function getFieldsCodesArray($entityModel)
    {
        $fieldsCodes = [];
        foreach($this->fields as $field){
            if(!empty($entityModel->{$field->code})) {
                if (empty($field->dictionary_id)) {
                    $fieldsCodes[] = $field->code;
                } else {
                    $fieldsCodes[] = [
                        'attribute' => $field->code,
                        'format' => 'html',
                        'value' => $field->getDictionaryValue($field->dictionary_id, $entityModel->{$field->code}),
                    ];
                }
            }
        }
        return $fieldsCodes;
    }

    public function getHtml($entityModel)
    {
        $html = $this->html;
        if(!empty($html)) {
            foreach ($this->fields as $field) {
                $html = str_replace('<%' . $field->code . '%>', $field->getView($entityModel), $html);
            }
        }else{

            $html = '<div class="panel panel-default box2">
                                <div class="panel-heading">
                                    <h3 class="panel-title">'.$this->title.'</h3>
                                </div>';
            $html .= DetailView::widget([
                        'model' => $entityModel,
                        'attributes' => $this->getFieldsCodesArray($entityModel),
                    ]);

            $html .= '</div>';
        }

        return $html;
    }

    public function getRoles()
    {
        return $this->hasMany(NodeViewRoleLink::className(), ['view_id' => 'id']);
    }

    public function checkRole()
    {
        $user = User::findOne(Yii::$app->user->id);
        if(!empty($user)) {
            foreach ($this->roles as $role) {
                foreach ($user->roles as $userRole) {
                    if ($role->role_id == $userRole->id) {
                        return true;
                    }
                }
            }
        }

        return false;
    }
}
