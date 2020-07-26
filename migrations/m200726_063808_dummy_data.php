<?php

use yii\db\Migration;

/**
 * Class m200726_063808_dummy_data
 */
class m200726_063808_dummy_data extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->insert('{{%store}}', ['title' => 'Amazon']);
        $this->insert('{{%store}}', ['title' => 'Ebay']);
        $this->insert('{{%store}}', ['title' => 'Wallmart']);
    }
    
    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        return true;
    }
    
}
