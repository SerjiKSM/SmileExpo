<?php

use yii\db\Migration;

/**
 * Class m180519_083502_products
 */
class m180519_083502_products extends Migration
{

    protected $tableName = 'products';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable($this->tableName, [
                'id' => $this->primaryKey(),
                'title' => $this->string(255),
                'description' => $this->text(),
                'path_photo' => $this->string(255),
                'cost' => $this->double(),
                'category_id' => $this->integer(),
            ]

        );

        $this->addForeignKey(
            "fk-{$this->tableName}-category_id",
            $this->tableName,
            "category_id",
            "categories_product",
            "id",
            "CASCADE",
            "CASCADE"
        );

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {

        $this->dropForeignKey(
            "fk-{$this->tableName}-category_id",
            $this->tableName
        );

        $this->dropTable($this->tableName);
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180519_083502_products cannot be reverted.\n";

        return false;
    }
    */
}
