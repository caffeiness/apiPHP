<?php
putenv("GOOGLE_APPLICATION_CREDENTIALS=my-first-project.json");
require __DIR__ . '/vendor/autoload.php';

use Google\Cloud\Vision\V1\Feature\Type;
use Google\Cloud\Vision\V1\ImageAnnotatorClient;
use Google\Cloud\Vision\V1\Likelihood;

print_r($_FILES['upload_image']['name']);
$imagePath = $_FILES['upload_image']['name']; 
$imageAnnotator = new ImageAnnotatorClient(); 
$image = file_get_contents($imagePath); 
$response = $imageAnnotator->textDetection($image); 
$texts = $response->getTextAnnotations(); 
foreach ($texts as $text) {
 unset($result);
 $result = $text->getDescription();
 //整形、日本語ではよく「〜」が半角チルダになっているので
 $result = trim($result);
 $result = preg_replace("/\~/", "ー", $result );
 $result = str_replace(array("\r\n","\r","\n"), '', $result);
 $resultArr[] = $result;
} 
//返り値が結構バラバラなので文字数が多い順に並び替え 
array_multisort( array_map( "strlen", $resultArr ), SORT_DESC, $resultArr ) ; 
$imageAnnotator->close(); 
//最も長い文字列だけを取得 
echo $resultArr[0];
?>

<html>
<head lang="ja">
  <title>姫騎士の魂</title>

</head>
  <body>
  <div class="twitter">
    <a href="https://twitter.com/share?ref_src=twsrc%5Etfw" class="twitter-share-button" data-size="large" data-show-count="false">Tweet</a>
    <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
　</div>
  </body>
</html>