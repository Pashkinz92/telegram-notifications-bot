<?php

namespace webstik\telegramNotifications\models;

use Yii;
use webstik\telegramNotifications\models\query\TelegramUserQuery;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "telegram_users".
 *
 * @property integer $id
 * @property string $chat_id
 * @property string $first_name
 * @property string $last_name
 * @property string $username
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $is_allowed
 *
 * @property TelegramLogs[] $telegramLogs
 */
class TelegramUser extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'telegram_users';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created_at', 'updated_at', 'is_allowed', 'allowed_by'], 'integer'],
            [['allowed_at'], 'safe'],
            [['chat_id', 'first_name', 'last_name', 'username'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'chat_id' => 'Chat ID',
            'first_name' => 'Имя',
            'last_name' => 'Фамилия',
            'username' => 'Username',
            'created_at' => 'Дата создания',
            'updated_at' => 'Дата обновления',
            'is_allowed' => 'Статус',
            'allowed_by' => 'Кем допущен',
            'allowed_at' => 'Допущен',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTelegramLogs()
    {
        return $this->hasMany(TelegramLogs::className(), ['telegram_user_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return TelegramUserQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TelegramUserQuery(get_called_class());
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }
}
