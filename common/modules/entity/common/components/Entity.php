<?php
/**
 * Created by PhpStorm.
 * User: a_niyazov
 * Date: 03.03.2015
 * Time: 12:24
 */

namespace common\modules\entity\common\components;

use common\helpers\DebugHelper;
use Yii;
use yii\data\ActiveDataProvider;
/**
 * This is the model class for all data sets.
 */
class Entity extends \yii\db\ActiveRecord
{
    const TABLE = 'table';
    const RULES = 'rules';
    const SEARCH_RULES = 'search_rules';
    const SEARCH_PARAMS = 'search_params';
    const LABELS = 'labels';

    protected static $entityType = null;

    protected static $table = null;
    protected static $rules = null;
    protected static $attributeLabels = null;
    protected static $searchRules = null;
    protected static $searchParams = null;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return self::$table;
    }

    /**
     * Returns the database connection used by this AR class.
     * I override this method to use a data sets database connection.
     * @return Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->pdb;
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return self::$rules;
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return self::$attributeLabels;
    }

    /**
     * @inheritdoc
     */
    public function modelInit($params)
    {
        self::$table = $params[self::TABLE];
        self::$rules = $params[self::RULES];
        self::$attributeLabels = $params[self::LABELS];
        self::$searchRules = $params[self::SEARCH_RULES];
        self::$searchParams = $params[self::SEARCH_PARAMS];
    }

    /**
     * @inheritdoc
     */
    public function setTable($table)
    {
        self::$table = $table;
    }

    /**
     * @inheritdoc
     */
    public function setRules($rules)
    {
        self::$rules = $rules;
    }

    /**
     * @inheritdoc
     */
    public function setAttributeLabels($labels)
    {
        self::$attributeLabels = $labels;
    }

    public function setEntityType($entityType)
    {
        self::$entityType = $entityType;
    }

    public function getEntityType()
    {
        return self::$entityType;
    }

    public function getDictionaryValue($field_code)
    {

    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search()
    {

        self::$rules = self::$searchRules;
        //DebugHelper::printSingleObjectAndDie(self::$rules);

        $query = self::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load(Yii::$app->request->queryParams);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
        ]);

        foreach(self::$searchParams as $field => $operator){
            $query->andFilterWhere([$operator, $field, $this->{$field}]);
        }



        return $dataProvider;
    }
}
