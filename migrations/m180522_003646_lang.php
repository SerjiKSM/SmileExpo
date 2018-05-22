<?php

use yii\db\Migration;

/**
 * Class m180522_003646_lang
 */
class m180522_003646_lang extends Migration
{

    protected $tableName = 'lang';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable($this->tableName, [
                'id' => $this->primaryKey(),
                'url' => $this->string(255)->notNull(),
                'local' => $this->string(255)->notNull(),
                'name' => $this->string(255)->notNull(),
                'default' => $this->smallInteger(6)->notNull()->defaultValue(0),
                'date_update' => $this->integer(11)->notNull(),
                'date_create' => $this->integer(11)->notNull(),
            ]

        );

        $this->batchInsert('lang', ['url', 'local', 'name', 'default', 'date_update', 'date_create'], [
            ['en', 'en-EN', 'English', 0, time(), time()],
            ['ru', 'ru-RU', 'Русский', 1, time(), time()],
        ]);

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
        echo "m180522_003646_lang cannot be reverted.\n";

        return false;
    }
    */
}
