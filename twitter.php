<?php
require('vendor/autoload.php');
 
use Abraham\TwitterOAuth\TwitterOAuth;

$json = file_get_contents('twitterAccount.json');
$json = mb_convert_encoding($json, 'UTF8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN');
$json = json_decode($json,true);

$consumer_key = $json["consumerKey"];
$consumer_key_sercret = $json["consumerSecret"];
$access_token = $json["accessToken"];
$access_token_secret = $json["accessTokenSecret"];
 
$connection = new TwitterOAuth($consumer_key, $consumer_key_sercret, $access_token, $access_token_secret);
 
$res = $connection->post('statuses/update', ['status' => '珍ぽにゃ']);