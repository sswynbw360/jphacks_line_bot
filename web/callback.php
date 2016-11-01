<?php
require_once　__DIR__ .'../vendor/autoload.php';


$accessToken = getenv('LINE_CHANNEL_ACCESS_TOKEN');

//ユーザーからのメッセージ取得
$json_string = file_get_contents('php://input');
$jsonObj = json_decode($json_string);

$type = $jsonObj->{"events"}[0]->{"message"}->{"type"};
//メッセージ取得
$text = $jsonObj->{"events"}[0]->{"message"}->{"text"};
//ReplyToken取得
$replyToken = $jsonObj->{"events"}[0]->{"replyToken"};
$join = $jsonObj->{"events"}[0]->type;

$userid = $jsonObj->{"events"}[0]->{"sourse"}->{"userid"};
$ch="";

//メッセージ以外のときは何も返さず終了
if($type != "text"){
	exit;
}
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
?>
