<?php

use yii\db\Migration;

/**
 * Class m200726_121500_import_info_failed
 */
class m200726_121500_import_info_failed extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%import_info}}', 'failed_count', 'integer DEFAULT 0');
        $this->renameColumn('{{%import_info}}', 'count', 'imported_count');
    }
    
    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->renameColumn('{{%import_info}}', 'imported_count', 'count');
        $this->dropColumn('{{%import_info}}', 'failed_count');
    }
}
