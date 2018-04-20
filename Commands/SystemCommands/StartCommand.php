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

use Longman\TelegramBot\Commands\SystemCommand;
use Longman\TelegramBot\Request;
use webstik\telegramNotifications\models\TelegramUser;

/**
 * Start command
 */
class StartCommand extends SystemCommand
{
    /**
     * @var string
     */
    protected $name = 'start';

    /**
     * @var string
     */
    protected $description = 'Start command';

    /**
     * @var string
     */
    protected $usage = '/start';

    /**
     * @var string
     */
    protected $version = '1.0.0';

    /**
     * Command execute method
     *
     * @return mixed
     * @throws \Longman\TelegramBot\Exception\TelegramException
     */
    public function execute()
    {
        $message = $this->getMessage();
        $chat_id = strval($message->getChat()->getId());
        //$chat_id = $message->getChat()->getId();
        $first_name = $message->getFrom()->getFirstName();
        $last_name = $message->getFrom()->getLastName();
        $username = $message->getFrom()->getUsername();

        $is_chat = ($m = TelegramUser::find()->user_chat_id($chat_id)->exists());
        if ($is_chat == false) {
            $model = new TelegramUser();
            $model->chat_id = $chat_id;
            if ($first_name != '') {
                $model->first_name = $first_name;
            }
            if ($last_name != '') {
                $model->last_name = $last_name;
            }
            if ($username != '') {
                $model->username = $username;
            }
            $model->save();
        }

        $user = TelegramUser::find()->user_chat_id($chat_id)->allowed()->exists();
        if ($user == true) {
            $tex = "Вы уже подписаны на этого бота";
        } else {
            $tex = "Введите PIN-код";
        }

        Request::sendMessage(['chat_id' => $chat_id, 'text' => $tex]);


        return parent::execute();
    }
}
