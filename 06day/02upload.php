<?php
/*
サービス公開時とそうでない時で記述をいちいち書き換えるのは面倒な上にミスの元なので、極力最小の労力で設定が書き換わるようにしておくのが望ましい。以下はURLがlocalhostか否かで設定を切り替える例。
*/
$is_develop = $_SERVER['HTTP_HOST'] === 'localhost';
if($is_develop){
  error_reporting(E_ALL);
  ini_set('display_errors', '1');
}else{
  error_reporting(E_ALL ^ E_NOTICE);
  ini_set('display_errors', '0');
  }
/**************/

$title = 'ファイルのアップロード';
?>

<html>
	<head>
		<title>
			<?php  
			print($title); 
			?>
		</title>
		</head>
		<body>
			
		<h1>
			<?php 
			print($title); 
			?>
		</h1>
		
		<form method="POST" action="02upload_save02.php" enctype="multipart/form-data">
			<input type="hidden" name="max_file_size" value="1000000" />
			<input type="file" name="upload_file" size="70" />
			<p><input type="submit" value="アップロード"></p>
		</form>
	</body>
</html>