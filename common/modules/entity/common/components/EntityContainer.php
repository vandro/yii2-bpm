<?php
/**
 * Created by PhpStorm.
 * User: a_niyazov
 * Date: 17.08.2015
 * Time: 16:56
 */
namespace common\modules\entity\common\components;

use yii;
use yii\db\Schema;
use yii\web\HttpException;

class EntityContainer
{
    const NOT_NULL = 'NOT NULL';

    protected $entity;

    protected $options = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
    protected $table_name = '';
    protected $columns = [];

    protected function getDb()
    {
        return Yii::$app->pdb;
    }

    public function build()
    {
        if($this->entity->added < 1) {
            $rawSql = '';
            try {
                $command = $this->getDb()->createCommand()->createTable('{{' . $this->table_name . '}}', $this->columns, $this->options);
                $rawSql = $command->rawSql;
                $command->execute();
                foreach($this->entity->fields as $field){
                    $field->added = 1;
                    $field->save();
                }
                $this->entity->added = 1;
                $this->entity->save();
                return true;
            } catch (\Exception $e) {
                throw Yii::$app->db->getSchema()->convertException($e, $rawSql);
            }
        }else{
            throw new HttpException('The table is exist.');
        }

    }

    public function setEntity($entity)
    {
        $this->entity = $entity;
        $this->table_name = $entity->code;
    }

    public function setColumns($columns)
    {
        if(!isset($columns['task_id'])) {
            $this->columns = array_merge([
                'id' => Schema::TYPE_PK,
                'task_id' => Schema::TYPE_INTEGER,
            ],
                $columns
            );
        }else{
            $this->columns = array_merge([
                'id' => Schema::TYPE_PK,
            ],
                $columns
            );
        }

    }

    public function addColumn($field)
    {
        if($field->added < 1) {
            $rawSql = '';
            try {
                $type = $field->type;
                if($field->type != 'TEXT' && $field->type != 'DATE') {
                    $type .= '('.$field->length.')';
                }
                $command = $this->getDb()->createCommand()->addColumn($this->entity->code, $field->code, $type);
                $rawSql = $command->rawSql;
                $command->execute();
                $field->added = 1;
                $field->save();
                return true;
            } catch (\Exception $e) {
                throw Yii::$app->db->getSchema()->convertException($e, $rawSql);
            }
        }else{
            throw new HttpException('The field is exist.');
        }
    }
}