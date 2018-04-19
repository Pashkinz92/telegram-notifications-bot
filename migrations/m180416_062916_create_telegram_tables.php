<?php

//namespace webstik\telegramNotifications\migrations;

use yii\db\Migration;

/**
 * Handles the creation of table `telegram_users`.
 */
class m180416_062916_create_telegram_tables extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('telegram_users', [
            'id' => $this->primaryKey(),
            'chat_id' => $this->string(50),
            'first_name' => $this->string(50),
            'last_name' => $this->string(50),
            'username' => $this->string(50),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'is_allowed' => $this->boolean()->defaultValue(0),
            'allowed_by' => $this->integer(),
            'allowed_at' => $this->dateTime(),
        ]);

        $this->createTable('telegram_logs', [
            'log_id' => $this->primaryKey(),
            'telegram_user_id' => $this->integer(),
            'message' => $this->text(),
            'is_sent' => $this->boolean()->defaultValue(0),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ]);


        $this->createTable('telegram_settings', [
            'id' => $this->primaryKey(),
            'webhook_url' => $this->string(255),
            'do_logs' => $this->boolean()->defaultValue(1),
            'token' => $this->string(255),
            'PIN_code' => $this->integer(),
        ]);

        $this->createIndex(
            'idx-telegram_logs-telegram_user_id',
            'telegram_logs',
            'telegram_user_id'
        );

        $this->addForeignKey(
            'fk-telegram_logs-telegram_user_id',
            'telegram_logs',
            'telegram_user_id',
            'telegram_users',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'fk-telegram_logs-telegram_user_id',
            'telegram_logs'
        );

        // drops index for column `author_id`
        $this->dropIndex(
            'idx-telegram_logs-telegram_user_id',
            'telegram_logs'
        );

        $this->dropTable('telegram_users');
        $this->dropTable('telegram_logs');
        $this->dropTable('telegram_settings');
    }
}
