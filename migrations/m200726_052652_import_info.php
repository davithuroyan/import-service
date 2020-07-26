<?php

use yii\db\Migration;

/**
 * Class m200726_052652_import_info
 */
class m200726_052652_import_info extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(
            '{{%import_info}}',
            [
                'id' => $this->primaryKey(),
                'task_id' => $this->integer(),
                'count' => $this->integer()
            ]
        );
        
        $this->addForeignKey(
            'fk_import_info_task_id',
            '{{%import_info}}',
            'task_id',
            '{{%import_task}}',
            'id'
        );
    }
    
    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_import_info_task_id', '{{%import_info}}');
        $this->dropTable('{{%import_info}}');
    }
}
