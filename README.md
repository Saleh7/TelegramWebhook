# TelegramWebhook
Telegram Webhook PHP

### Create a New Bot
1. Add [@BotFather](https://telegram.me/botfather) to start conversation.
2. Type `/newbot` and **@BotFather** will ask the name for your bot.
3. Choose a cool name, for example `My Bot` and hit enter.
4. Now choose a username for your bot. It must end in *bot*, for example `MyBot` or `My_Bot`.
5. If succeed, **@BotFather** will give you API key to be used in this library.

### Configuration (WebHook)
1. Navigate to https://api.telegram.org/bot(BOT_ID)/setWebhook?url=https://yoursite.com/WebHook.php
2. Telegram do not support http, your site should have valid SSL (HTTPS).
3. If correct, telegram should response
```php
{
    "ok": true,
    "result": true,
    "description": "Webhook was set"
}
```
Example WebHook.php
--------------
```php
require_once('Telegram.php');

$Token = "112488787:AAHh3GekYvSR_pEMKAfyjxAOjgX7ul2lACo"; //Your Api Key Here
$WebHook = "https://www.****.com/test/WebHook.php"; // Your Url Webhook

$Web = new TelegramBot($Token);


if (php_sapi_name() == 'cli') {
  $Web->Request('setWebhook', array(
  	'url' => isset($argv[1]) &&
  	$argv[1] == 'delete' ? '' : $WebHook));
  exit;
}

$Data = file_get_contents("php://input");
$Web->Run($Data);

```
