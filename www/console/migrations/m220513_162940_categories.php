<?php

use yii\db\Migration;

/**
 * Class m220513_162940_categories
 */
class m220513_162940_categories extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('categories', [
            'id' => $this->primaryKey(),
            'pid' => $this->integer()->defaultValue(0)->unsigned()->notNull(),
            'title' => $this->string(),
        ]);
        $this->createIndex('index_categories', 'categories', ['pid']);

        $this->insert('categories', [
            'id' => 1,
            'pid' => 0,
            'title' => 'Category 1',
        ]);

        $this->insert('categories', [
            'id' => 2,
            'pid' => 0,
            'title' => 'Category 2',
        ]);

        $this->insert('categories', [
            'id' => 3,
            'pid' => 1,
            'title' => 'Category 1.1',
        ]);

        $this->insert('categories', [
            'id' => 4,
            'pid' => 3,
            'title' => 'Category 1.1.1',
        ]);
    }


    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('categories');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220513_162940_categories cannot be reverted.\n";

        return false;
    }
    */
}
