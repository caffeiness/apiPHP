<?php
putenv("GOOGLE_APPLICATION_CREDENTIALS=my-first-project.json");
require __DIR__ . '/vendor/autoload.php';

use Google\Cloud\Vision\V1\Feature\Type;
use Google\Cloud\Vision\V1\ImageAnnotatorClient;
use Google\Cloud\Vision\V1\Likelihood;

ini_set('display_errors', 0);
print_r($_FILES['upload_image']['name']);
echo "<br />";
$imagePath = $_FILES['upload_image']['name']; 
move_uploaded_file($_FILES["upload_image"]["tmp_name"],"./tmp/".$imagePath);
$imageAnnotator = new ImageAnnotatorClient(); 
if ( file_exists ("./tmp/".$imagePath ) && exif_imagetype("./tmp/".$imagePath)) {
  echo "OK";
}else{
  echo "画像を選択してください";
}
$image = file_get_contents("./tmp/".$imagePath); 
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
var_dump($resultArr);
//返り値が結構バラバラなので文字数が多い順に並び替え 
array_multisort( array_map( "strlen", $resultArr ), SORT_DESC, $resultArr ) ; 
//var_dump($resultArr);
$imageAnnotator->close(); 
//最も長い文字列だけを取得 
?>

<html>
<head lang="ja">
  <title>画像認識API</title>
  <link href="style.css" rel="stylesheet">

</head>
  <body>
    <div class="glass-container" id="glass">
      <?php echo $resultArr[0] ?>
    </div>
    <div class="twitter">
      <a href="https://twitter.com/share?ref_src=twsrc%5Etfw" class="twitter-share-button"  data-size="large" data-show-count="false">Tweet</a>
      <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
    </div>
  </body>
</html>