<?php
require('vendor/autoload.php');
$channel_access_token = 'eSHZz1GERNKm+XPvRfd15iY/0w8qSUofgH2jc319Rjn5A/Umsk8iZNxUr/X/Sg0by7SlAIcPKXP9v7c6ykb52kY8GTB4ItOLk6GrU2fXu+q95Dd2GdurZEhmDH5viL/DvE6ePrb83K5AyHYqLF/gLgdB04t89/1O/w1cDnyilFU=';
$channel_secret = '39e9652b9607488eac0d2fbb1de588a7';

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