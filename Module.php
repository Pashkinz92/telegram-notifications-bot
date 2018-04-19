<?php

namespace webstik\telegramNotifications;

/**
 * telegramNotifications module definition class
 */
class Module extends \yii\base\Module
{
    public $nameModule = 'telegramNotifications';
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'webstik\telegramNotifications\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
}
