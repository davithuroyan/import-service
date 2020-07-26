<?php

use yii\db\Migration;

/**
 * Class m200725_214010_import_tasks
 */
class m200725_214010_import_tasks extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(
            '{{%import_task}}',
            [
                'id' => $this->primaryKey(),
                'store_id' => $this->integer(),
                'file' => $this->string(),
                'datetime' => $this->timestamp(),
                'status' => $this->tinyInteger()
            ]
        );
        
        $this->addForeignKey(
            'fk_import_task_store_id',
            '{{%import_task}}',
            'store_id',
            '{{%store}}',
            'id'
        );
    }
    
    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200725_214010_import_tasks cannot be reverted.\n";
        
        return false;
    }
}
