<?php

use yii\db\Migration;

/**
 * Class m180519_074311_categories_product
 */
class m180519_074311_categories_product extends Migration
{

    protected $tableName = 'categories_product';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable($this->tableName, [
                'id' => $this->primaryKey(),
                'title' => $this->string(255),
                'description' => $this->text(),
            ]

        );

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable($this->tableName);
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180519_074311_categories_product cannot be reverted.\n";

        return false;
    }
    */
}
