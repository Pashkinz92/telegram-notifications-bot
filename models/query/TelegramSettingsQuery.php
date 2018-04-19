<?php

namespace webstik\telegramNotifications\models\query;

use webstik\telegramNotifications\models\TelegramSettings;
/**
 * This is the ActiveQuery class for [[TelegramSettings]].
 *
 * @see TelegramSettings
 */
class TelegramSettingsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return TelegramSettings[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return TelegramSettings|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
