Telegram notifications
=====================
This is extension for Telegram notifications.
 
Docs for **yii2 advanced template** 

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist webstik/yii2-telegram-notifications:dev-master
```

or add

```
"webstik/yii2-telegram-notifications": "dev-master"
```

to the require section of your `composer.json` file.


# Usage
###Module
This extension implements usage of telegram WebHooks. To handle requests  
you must configure the module in the backend side with a name of `telegramNotifications` as shown below: 

```php
'modules' => [
   'telegramNotifications' =>  [
        'class' => '\webstik\telegramNotifications\Module'
    ]
],
```

###Migrations
This extension uses DB for saving configuration of telegram bot. You must add configure the `console/main.php` file the migrations as shown below:  


```php
'controllerMap' => [
    'migrate-webstik-telegram' => [
        'class' => 'yii\console\controllers\MigrateController',
        'migrationTable' => 'migration_webstik_telega',
        'migrationPath' => '@webstik/telegramNotifications/migrations',
    ],
],
```

and then run the console command:
```php
php yii migrate-webstik-telegram
```

###UI
After configure you can use web pages for set webhooks, token and pin-code. Just follow the link:

```/index.php?r=<moduleName>/telegram-setting```

or
 
```/index.php?r=telegramNotifications/telegram-setting```

or
 
```/telegramNotifications/telegram-setting``` 

###Subscribed users
List of subscribed users will be available by link

```/telegramNotifications/telegram-users```
