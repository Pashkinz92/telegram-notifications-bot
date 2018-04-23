<?php
/**
 * This file is part of the TelegramBot package.
 *
 * (c) Avtandil Kikabidze aka LONGMAN <akalongman@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Longman\TelegramBot\Commands\SystemCommands;

use Longman\TelegramBot\Conversation;
use Longman\TelegramBot\Exception\TelegramException;
use Longman\TelegramBot\Request;
use Longman\TelegramBot\Commands\SystemCommand;
use webstik\telegramNotifications\models\TelegramSettings;
use webstik\telegramNotifications\models\TelegramUser;

/**
 * Generic message command
 */

class GenericmessageCommand extends SystemCommand
{
    /**
     * @var string
     */
    protected $name = 'genericmessage';

    /**
     * @var string
     */
    protected $description = 'Handle generic message';

    /**
     * @var string
     */
    protected $version = '1.1.0';

    /**
     * @var bool
     */
    protected $need_mysql = true;

    /**
     * Execution if MySQL is required but not available
     *
     * @return \Longman\TelegramBot\Entities\ServerResponse
     */
    public function executeNoDb()
    {
        //Do nothing
        //file_put_contents('telega.log', print_r($this->getMessage()->getText(), true)."\n", FILE_APPEND);

        $message = $this->getMessage();
        $chat_id = strval($message->getChat()->getId());

        $telegram_setting = TelegramSettings::getSettings();
            if ((TelegramUser::find()->user_chat_id($chat_id)->allowed()->exists()) == true) return Request::emptyResponse();
            if ($message->getText() == $telegram_setting->PIN_code) {
                Request::sendMessage(['chat_id' => $chat_id, 'text' => 'PIN-код введён правильно']);

                $user = TelegramUser::find()->user_chat_id($chat_id)->one();
                $user->is_allowed = 1;
                $user->save();

            } else {
                Request::sendMessage(['chat_id' => $chat_id, 'text' => 'PIN-код введён не правильно. Повторите ввод']);
            }

        return Request::emptyResponse();
    }

    /**
     * Execute command
     *
     * @return \Longman\TelegramBot\Entities\ServerResponse
     * @throws \Longman\TelegramBot\Exception\TelegramException
     */
    public function execute()
    {
        //If a conversation is busy, execute the conversation command after handling the message
        $conversation = new Conversation(
            $this->getMessage()->getFrom()->getId(),
            $this->getMessage()->getChat()->getId()
        );
        file_put_contents('telega.log', print_r(__FILE__ . ':' . __LINE__, true) . "\n", FILE_APPEND);

        //Fetch conversation command if it exists and execute it
        if ($conversation->exists() && ($command = $conversation->getCommand())) {
            return $this->telegram->executeCommand($command);
        }

        return Request::emptyResponse();
    }
}
