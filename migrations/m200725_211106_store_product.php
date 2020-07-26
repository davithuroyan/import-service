<?php

use yii\db\Migration;

/**
 * Class m200725_211106_store_product
 */
class m200725_211106_store_product extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(
            '{{%store_product}}',
            [
                'id' => $this->primaryKey(),
                'store_id' => $this->integer(),
                'upc' => $this->string(),
                'title' => $this->string(),
                'price' => $this->double()
            ]
        );
        
        $this->addForeignKey(
            'fk_product_store_id',
            '{{%store_product}}',
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
        $this->dropForeignKey('fk_product_store_id', '{{%store_product}}');
        $this->dropTable('{{%store_product}}');
    }
   }
