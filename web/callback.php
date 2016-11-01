<?php
require('../vendor/autoload.php');

//ユーザーからのメッセージ取得
$json_string = file_get_contents('php://input');
$json = json_decode($json_string);
$event = $json->events[0];

$httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient('zhvKsOOA3F09IbOkr26vawp7coqjKVcdOCGUmdKW1KvJ/gIpz/B8vq/JdhFrwwTi5EdpwgFYWbyPWKka/EfsRlWVoga3FtoC5peDFf5lU6Xax5cX18znSX9s+d47IPb1y/bPFMfFnmMD1Db6v1RU+wdB04t89/1O/w1cDnyilFU=');
$bot = new \LINE\LINEBot($httpClient, ['channelSecret' => '77d574f6714aa59abe2a2e5db99b5edb']);

if("message"==$event->type){

  if("@bye" == $event->message->text && ("group"==$event->source->type || "room"==$event->source->type)){

  }elseif("@join"==$event->message->text){
    $response = $bot->getProfile($event->source->userId);
      if ($response->isSucceeded()) {
        $profile = $response->getJSONDecodedBody();
        $textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder($profile['displayName'] . "はゲームに参加したよ！");
        $response2 = $bot->replyMessage($event->replyToken, $textMessageBuilder);
    }
  }
}
elseif("follow"==$event->type){

}
elseif("join"==$event->type){
  $textMessageBuilder = new \LINE\LINEBot\MessageBuilder\textMessageBuilder("やあ！");
}
elseif("beacon"==$event->type){

}
else{

}
return;

?>
