<?php

use yii\db\Migration;

/**
 * Class m220513_163541_products_to_categories
 */
class m220513_163541_products_to_categories extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('product_to_category', [
            'id' => $this->primaryKey(),
            'category_id' => $this->integer(),
            'product_id' => $this->integer(),
        ]);
        $this->addForeignKey('foreign_to_category', 'product_to_category', 'category_id', 'categories', 'id');
        $this->addForeignKey('foreign_to_product', 'product_to_category', 'product_id', 'products', 'id');
        $this->createIndex('index_product_to_category', 'product_to_category', ['category_id', 'product_id']);

        $this->insert('product_to_category', [
            'id' => 1,
            'category_id' => 1,
            'product_id' => 1,
        ]);

        $this->insert('product_to_category', [
            'id' => 2,
            'category_id' => 2,
            'product_id' => 1,
        ]);

        $this->insert('product_to_category', [
            'id' => 3,
            'category_id' => 3,
            'product_id' => 2,
        ]);

        $this->insert('product_to_category', [
            'id' => 4,
            'category_id' => 3,
            'product_id' => 3,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('product_to_category');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220513_163541_products_to_categories cannot be reverted.\n";

        return false;
    }
    */
}
