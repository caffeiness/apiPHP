<?php
putenv("GOOGLE_APPLICATION_CREDENTIALS=my-first-project.json");
require __DIR__ . '/vendor/autoload.php';
use Google\Cloud\Vision\V1\ImageAnnotatorClient;
if(!empty($_FILES)){
    print("das");
    }else{
      $MSG = '画像を選択してください';
    }   
//filenameの受け渡しができていなく画像がないといわれている
$filename = isset($_FILES["upload_image"]["name"]) ? $_FILES["upload_image"]["name"] : "";
echo $filename;
//$upload_file = "/".$filename;
$imageAnnotator = new ImageAnnotatorClient();
$image = @file_get_contents(__DIR__ . $filename);// ここにファイル名
$response = $imageAnnotator->labelDetection($image);
$labels = $response->getLabelAnnotations();
 
if ($labels) {
    echo("Labels:" . PHP_EOL);
    foreach ($labels as $label) {
        echo($label->getDescription() . PHP_EOL);
    }
} else {
    echo('No label found' . PHP_EOL);
}
?>
