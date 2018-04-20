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
class CancelCommand extends SystemCommand
{
    /**
     * @var string
     */
    protected $name = 'cancel';

    /**
     * @var string
     */
    protected $description = 'Cancel command';

    /**
     * @var string
     */
    protected $usage = '/cancel';

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
        
        $user = TelegramUser::find()->user_chat_id($chat_id)->allowed()->exists();
        if ($user == true) {
            $tex = "Вы отписались от этого бота";
            $user = TelegramUser::find()->user_chat_id($chat_id)->one();
            $user->is_allowed = 0;
            $user->save();

        } else {
            $tex = "Вы не были подписаны на этого бота";
        }

        Request::sendMessage(['chat_id' => $chat_id, 'text' => $tex]);


        return parent::execute();
    }
}
