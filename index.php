<?php
putenv("GOOGLE_APPLICATION_CREDENTIALS=my-first-project.json");
require __DIR__ . '/vendor/autoload.php';
use Google\Cloud\Vision\V1\ImageAnnotatorClient;

$imageAnnotator = new ImageAnnotatorClient();
$image = file_get_contents(__DIR__ . '/Fotolia_71261977_M.jpg');// ここにファイル名
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