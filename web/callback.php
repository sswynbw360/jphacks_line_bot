<?php
require('../vendor/autoload.php');


//$accessToken = getenv('LINE_CHANNEL_ACCESS_TOKEN');

//ユーザーからのメッセージ取得
$json_string = file_get_contents('php://input');
$json = json_decode($json_string);
$event = $json->events[0];
//ReplyToken取得
//$replyToken = $json->{"events"}[0]->{"replyToken"};

$httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient('zhvKsOOA3F09IbOkr26vawp7coqjKVcdOCGUmdKW1KvJ/gIpz/B8vq/JdhFrwwTi5EdpwgFYWbyPWKka/EfsRlWVoga3FtoC5peDFf5lU6Xax5cX18znSX9s+d47IPb1y/bPFMfFnmMD1Db6v1RU+wdB04t89/1O/w1cDnyilFU=');
$bot = new \LINE\LINEBot($httpClient, ['channelSecret' => '77d574f6714aa59abe2a2e5db99b5edb']);

if("message"==$event->type){
  if(("@bye"==$event->message->text) && (("group"==$event->source->type) ||("room"==$event->source->type))){

  }else if("@join"==$event->message->text){
    $response = $httpClient->getProfile($event->source->userId);
      if ($response->isSucceeded()) {
        $profile = $response->getJSONDecodedBody();
        $textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder($profile['displayName'] . "はゲームに参加したよ！");
        $response2 = $bot->replyMessage($event->replyToken, $textMessageBuilder);
    }
  }
}
else if("follow"==$event->type){

}
else if("join"==$event->type){
  $textMessageBuilder = new \LINE\LINEBot\MessageBuilder\textMessageBuilder("やあ！");
}
else if("beacon"==$event->type){

}
else{

}
/*
//返信データ作成
if ($text == '@人狼') {
  $response_format_text = [
    "type" => "template",
    "altText" => "ようこそ人狼へ",
    "template" => [
        "type" => "buttons",
        "text" => "ようこそ人狼へ",
        "actions" => [
            [
              "type" => "message",
              "label" => "@help",
              "text" => "@help"
            ],
            [
              "type" => "message",
              "label" => "@join",
              "text" => "@join"
            ],
            [
              "type" => "message",
              "label" => "@start",
              "text" => "@start"
            ]
        ]
    ]
  ];
}


  if($text == '@join'){
    $response_format_text=
      ["userid" => $userid,
      "text" => [$profile['displayName']]
      ];
      //SQLのインサート文を書く
    $post_data = [
    "to" => $userid,
    "messages" => [$response_format_text]
    ];
    $ch = curl_init("https://api.line.me/v2/bot/message/push");
    cul_setopt();
  }

  else{
    $post_data = [
    "replyToken" => $replyToken,
    "messages" => [$response_format_text]
    ];
    $ch = curl_init("https://api.line.me/v2/bot/message/reply");
    cul_setopt();
  }
  
  function cul_setopt(){
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post_data));
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json; charser=UTF-8',
        'Authorization: Bearer ' . $accessToken
        ));
    $result = curl_exec($ch);

    curl_close($ch);
  }
  */
?>
