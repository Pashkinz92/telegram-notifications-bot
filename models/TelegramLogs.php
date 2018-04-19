<?php

namespace webstik\telegramNotifications\models;

use Yii;
use webstik\telegramNotifications\models\query\TelegramLogsQuery;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "telegram_logs".
 *
 * @property integer $log_id
 * @property integer $telegram_user_id
 * @property string $message
 * @property integer $is_sent
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property TelegramUser $telegramUser
 */
class TelegramLogs extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'telegram_logs';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['telegram_user_id', 'is_sent', 'created_at', 'updated_at'], 'integer'],
            [['message'], 'string'],
            [['telegram_user_id'], 'exist', 'skipOnError' => true, 'targetClass' => TelegramUser::className(), 'targetAttribute' => ['telegram_user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'log_id' => 'Log ID',
            'telegram_user_id' => 'Telegram User ID',
            'message' => 'Message',
            'is_sent' => 'Is Sent',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTelegramUser()
    {
        return $this->hasOne(TelegramUser::className(), ['id' => 'telegram_user_id']);
    }

    /**
     * @inheritdoc
     * @return TelegramLogsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TelegramLogsQuery(get_called_class());
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    static public function SetTelegramLog($user_id, $message)
    {
        $telegram_log = new TelegramLogs();
        $telegram_log->telegram_user_id = $user_id;
        $telegram_log->message = $message;
        $telegram_log->save();
    }
}
