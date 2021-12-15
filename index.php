<?php
require('vendor/autoload.php');
$json = file_get_contents('twitterAccount.json');
$json = mb_convert_encoding($json, 'UTF8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN');
$json = json_decode($json,true);

$channel_access_token = $json["channel_access_token"];
$channel_secret = $json["channel_secret"];

require_once('tick.php');

$client = new LINEBotTiny($channelAccessToken, $channelSecret);
foreach ($client->parseEvents() as $event) {
    switch ($event['type']) {
        case 'message':
            $message = $event['message'];
            switch ($message['type']) {
                case 'text':
                    $client->replyMessage(array(
                        'replyToken' => $event['replyToken'],
                        'messages' => array(
                            array(
                                'type' => 'text',
                                'text' => $message['text']
                            )
                        )
                    ));
                    break;
                default:
                    error_log("Unsupporeted message type: " . $message['type']);
                    break;
            }
            break;
        default:
            error_log("Unsupporeted event type: " . $event['type']);
            break;
    }
};

?>
<!-- <html>
<head>
    <meta charset="utf-8">
</head>
<body>
    <form action="sample.php" method="post" enctype="multipart/form-data">
        <p>ファイル：<input type="file" name="upload_image"></p>
        <p><input type="submit" value="送信"></p>
    </form>
</body>
</html>