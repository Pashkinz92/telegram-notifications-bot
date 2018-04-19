<?php

namespace webstik\telegramNotifications\models\query;

use webstik\telegramNotifications\models\TelegramLogs;
/**
 * This is the ActiveQuery class for [[TelegramLogs]].
 *
 * @see TelegramLogs
 */
class TelegramLogsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return TelegramLogs[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return TelegramLogs|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
