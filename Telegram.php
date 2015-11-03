<?php
require_once('Requests.class.php');
class TelegramBot{
    /**
     * Token API telegram
     * @example https://core.telegram.org/bots/api
     */
    private $API_Url;
    public $Requests;
    function __construct($API_Url,$Requests=null){
        $Urlapi = "https://api.telegram.org/bot".$API_Url."/";
        $this->API = $Urlapi;
        $this->R = isset($Requests) ? $Requests : new ClassRequest($this->API);
    }
    /**
     * @param integer  chat_id
     * @param string   text
     * @param boolean  disable_web_page_preview | true,false
     * @param integer|null  reply_to_message_id
     * @param integer|null  reply_markup
     * @telegram https://core.telegram.org/bots/api#sendmessage
     * Optional. For text messages, the actual UTF-8 text of the message
     */
    public function SendMessage($chat_id, $text, $disable_web_page_preview =true, $reply_to_message_id = null, $reply_markup = null){
        $data["chat_id"]= $chat_id;
        $data["text"]= $text;
        $data["disable_web_page_preview"] = $disable_web_page_preview;
        $data["reply_to_message_id"] = $reply_to_message_id;
        $data["reply_markup"] = $reply_markup;
        return $this->R->RequestWebhook("sendMessage", $data);
    }
    /**
     * @param string  chat_id
     * @param string   text
     */
    public function CheckALL($id_chat,$text){
        switch ($text) {
            case '/saleh':
                $Message = "hi";
                $this->SendMessage($id_chat,$Message);
                break;
        }
    }
    /**
     * @param DataWebhook  Updates
     */
    public function Run($Update){
        $Updates = json_decode($Update, true);
        if (!$Updates) {
          exit;
        }

        if (isset($Updates["message"])) {
            $id_chat       = @$Updates['message']['chat']['id'];

            $text          = @$Updates['message']['text'];
            $this->CheckALL($id_chat,$text);
        }
    }

}//End Class

?>
