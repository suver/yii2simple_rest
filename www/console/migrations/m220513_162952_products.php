<?php

use yii\db\Migration;

/**
 * Class m220513_162952_products
 */
class m220513_162952_products extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('products', [
            'id' => $this->primaryKey(),
            'title' =>$this->string(),
            'description' => $this->text(),
        ]);

        $this->insert('products', [
            'id' => 1,
            'title' => 'Product 1',
            'description' => 'Description',
        ]);

        $this->insert('products', [
            'id' => 2,
            'title' => 'Product 2',
            'description' => 'Description',
        ]);

        $this->insert('products', [
            'id' => 3,
            'title' => 'Product 3',
            'description' => 'Description',
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('products');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220513_162952_products cannot be reverted.\n";

        return false;
    }
    */
}
