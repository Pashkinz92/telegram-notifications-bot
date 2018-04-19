<?php

namespace webstik\telegramNotifications\models\query;

/**
 * This is the ActiveQuery class for [[TelegramUsers]].
 *
 * @see TelegramUsers
 */
class TelegramUserQuery extends \yii\db\ActiveQuery
{
    public function allowed()
    {
        return $this->andWhere(['is_allowed'=>1]);
    }

    public function user_chat_id($chat_id)
    {
        return $this->andWhere(['chat_id'=>$chat_id]);
    }
}
