<?php

use yii\db\Migration;

/**
 * Class m180519_103227_comments
 */
class m180519_103227_comments extends Migration
{

    protected $tableName = 'comments';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable($this->tableName, [
                'id' => $this->primaryKey(),
                'date' => $this->date('Y-m-d'),
                'user' => $this->string(255),
                'email' => $this->string(255)->unique(),
                'comment' => $this->text(),
                'product_id' => $this->integer(),
            ]

        );

        $this->addForeignKey(
            "fk-{$this->tableName}-product_id",
            $this->tableName,
            "product_id",
            "products",
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
            "fk-{$this->tableName}-product_id",
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
        echo "m180519_103227_comments cannot be reverted.\n";

        return false;
    }
    */
}
