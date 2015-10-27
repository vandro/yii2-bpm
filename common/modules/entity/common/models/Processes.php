<?php

namespace common\modules\entity\common\models;

use Yii;
use yii\data\ActiveDataProvider;

/**
 * This is the model class for table "processes".
 *
 * @property integer $id
 * @property string $title
 * @property string $code
 *
 * @property ProcessNodes[] $processNodes
 * @property ProcessesLang[] $processesLangs
 */
class Processes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'processes';
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
            [['title', 'code'], 'string'],
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
            'title' => Yii::t('app', 'Наименования'),
            'code' => Yii::t('app', 'Код'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNodes()
    {
        return $this->hasMany(ProcessNodes::className(), ['process_id' => 'id']);
    }

    public function getJsonNodesArray()
    {
        $arNodes = [];
        $index = 1;
        foreach($this->nodes as $node){
            if($node->order_status == 'last'){
                $borderWidth = 4;
                $shape = 'circle';
                $size = 60;
                $background = '#dd5555';
            }elseif($node->order_status == 'first'){
                $borderWidth = 4;
                $shape = 'circle';
                $size = 60;
                $background = '#ffffff';
            }elseif($node->order_status == 'filling'){
                $borderWidth = 4;
                $shape = 'circle';
                $size = 40;
                $background = 'lightgreen';
            }elseif($node->order_status == 'first_process'){
                $borderWidth = 4;
                $shape = 'box';
                $size = 60;
                $background = '#dd5555';
            }elseif($node->order_status == 'inactive'){
                $borderWidth = 4;
                $shape = 'box';
                $size = 60;
                $background = '#ffb928';
            }else{
                $borderWidth = 3;
                $shape = 'circle';
                $size = 35;
                $background = '#3399f3';
            }

            $arNodes[] = [
                'id' => $node->id,
                'label' => $index."/".$node->id,
                'title' => $node->title,
                'shape' => $shape,
                'font' => [
                    'size' => 20, //$size,
                    'color' => '#000000',
                ],
                'size' => $size,
                'color' => [
                    'background' => $background,
                    'border' => '#002240'
                ],
                'borderWidth' => $borderWidth,
            ];
            $index++;
        }

        return json_encode($arNodes);
    }

    public function getJsonEdgesArray()
    {
        $arEdges = [];
        $index = 1;
        foreach($this->nodes as $node){
            foreach($node->actionRoleLinks as $link) {
                $title = !empty($link->action)?$link->action->title:'';
                $title = !empty($link->role)?$title."(".$link->role->title.")":$title."()";
                $arEdges[] = [
                    'title' => $title,
                    'label' =>  $index."/".$link->id,
                    'from' => $node->id,
                    'to' => $link->next_node_id,
                    'arrows' => 'to',
                    'length' => 200,
                    'font' => [
                        'size' => 15,
                        'align' => 'bottom'
                    ],
                ];
                $index++;
            }
        }

        return json_encode($arEdges);
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function getNodesAdp()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => $this->getNodes(),
        ]);

        return $dataProvider;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLangs()
    {
        return $this->hasMany(ProcessesLang::className(), ['main' => 'id']);
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

    public function getLastNode()
    {
        foreach($this->nodes as $node){
            if($node->is_last()){
                return $node;
            }
        }

        return null;
    }

    public function getInactiveNode()
    {
        foreach($this->nodes as $node){
            if($node->is_inactive()){
                return $node;
            }
        }

        return null;
    }
}
