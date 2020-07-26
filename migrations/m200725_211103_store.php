<?php

use yii\db\Migration;

/**
 * Class m200725_211103_store
 */
class m200725_211103_store extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(
            '{{%store}}',
            [
                'id' => $this->primaryKey(),
                'title' => $this->string(),
            ]
        );
    }
    
    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%store}}');
    }
}
