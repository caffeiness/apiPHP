<?php
require('vendor/autoload.php');
$json = file_get_contents('twitterAccount.json');
$json = mb_convert_encoding($json, 'UTF8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN');
$json = json_decode($json,true);

$channel_access_token = $json["channel_access_token"];
$channel_secret = $json["channel_secret"];
/**
 * Copyright 2016 LINE Corporation
 *
 * LINE Corporation licenses this file to you under the Apache License,
 * version 2.0 (the "License"); you may not use this file except in compliance
 * with the License. You may obtain a copy of the License at:
 *
 *   https://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS, WITHOUT
 * WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the
 * License for the specific language governing permissions and limitations
 * under the License.
 */
require_once('LINEBotTiny.php');
$channelAccessToken = "eSHZz1GERNKm+XPvRfd15iY/0w8qSUofgH2jc319Rjn5A/Umsk8iZNxUr/X/Sg0by7SlAIcPKXP9v7c6ykb52kY8GTB4ItOLk6GrU2fXu+q95Dd2GdurZEhmDH5viL/DvE6ePrb83K5AyHYqLF/gLgdB04t89/1O/w1cDnyilFU=" ;
$channelSecret = "39e9652b9607488eac0d2fbb1de588a7";
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