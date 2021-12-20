<?php 
    echo "画像からテキストを抽出します。<br>";
    echo "コピペしてTwitterに投稿できます。";
?>
<html>
<head>
    <meta charset="utf-8">
    <link href="style.css" rel="stylesheet">
</head>
<body>
<div class="bg_test">
<div class="glass-container" id="glass">
    <form action="sample.php" method="post" enctype="multipart/form-data">
        <div class="file_button">
            <p><span>ファイルを選択</span><input class="file_input" type="file" name="upload_image"></p>
        </div>
        <p><input type="submit" value="送信"></p>
    </form>
</div>
</div>
</body>
</html>