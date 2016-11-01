<?php
require('../vendor/autoload.php');
//POST
$input = file_get_contents('php://input');
$json = json_decode($input);
$event = $json->events[0];
$httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient('zhvKsOOA3F09IbOkr26vawp7coqjKVcdOCGUmdKW1KvJ/gIpz/B8vq/JdhFrwwTi5EdpwgFYWbyPWKka/EfsRlWVoga3FtoC5peDFf5lU6Xax5cX18znSX9s+d47IPb1y/bPFMfFnmMD1Db6v1RU+wdB04t89/1O/w1cDnyilFU=');
$bot = new \LINE\LINEBot($httpClient, ['channelSecret' => '77d574f6714aa59abe2a2e5db99b5edb']);
//イベントタイプ判別
if ("message" == $event->type) {            //一般的なメッセージ(文字・イメージ・音声・位置情報・スタンプ含む)
    if ("@join" == $event->message->text) {
      $response = $bot->getProfile($event->source->userId);
      if ($response->isSucceeded()) {
        $profile = $response->getJSONDecodedBody();
        $textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder($profile['displayName'] . "はゲームに参加したよ！");
        $response2 = $bot->replyMessage($event->replyToken, $textMessageBuilder);
      }
      
    } else {
        $textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder("ごめん、わかんなーい(*´ω｀*)");
    }
} elseif ("follow" == $event->type) {        //お友達追加時
    $textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder("よろしくー");
} elseif ("join" == $event->type) {           //グループに入ったときのイベント
    $textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder('こんにちは よろしくー');
} elseif ('beacon' == $event->type) {         //Beaconイベント
    $textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder('Godanがいんしたお(・∀・) ');
} else {
    //なにもしない
}
//$response = $bot->replyMessage($event->replyToken, $textMessageBuilder);
syslog(LOG_EMERG, print_r($event->replyToken, true));
syslog(LOG_EMERG, print_r($response, true));
return;
