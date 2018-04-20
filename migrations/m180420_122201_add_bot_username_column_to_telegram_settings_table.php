<?php

use yii\db\Migration;

/**
 * Handles adding bot_username to table `telegram_settings`.
 */
class m180420_122201_add_bot_username_column_to_telegram_settings_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('telegram_settings', 'bot_username', $this->string(50));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('telegram_settings', 'bot_username');
    }
}
