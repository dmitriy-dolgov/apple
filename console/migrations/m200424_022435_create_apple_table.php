<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%apple}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%user}}`
 */
class m200424_022435_create_apple_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%apple}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(),
            'apple_data' => $this->text()->comment('JSON'),
        ]);

        // creates index for column `user_id`
        $this->createIndex(
            '{{%idx-apple-user_id}}',
            '{{%apple}}',
            'user_id'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-apple-user_id}}',
            '{{%apple}}',
            'user_id',
            '{{%user}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%user}}`
        $this->dropForeignKey(
            '{{%fk-apple-user_id}}',
            '{{%apple}}'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            '{{%idx-apple-user_id}}',
            '{{%apple}}'
        );

        $this->dropTable('{{%apple}}');
    }
}
