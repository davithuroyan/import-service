<?php

use yii\db\Migration;

/**
 * Class m200726_124245_imprort_info_default_value
 */
class m200726_124245_imprort_info_default_value extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('{{%import_info}}', 'imported_count', 'integer default 0');
    }
    
    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        return true;
    }
}
