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

$title = 'xmlインプット';
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
			print($title."（書き込み）"); 
			?>
		</h1>
		
		<form method="POST" action="02xml_write.php">
			<input type="text" name="name" size="20" maxlength="255" /><br/>
			メッセージ：
			<input type="text" name="message" size="70" maxlength="255" /><br/>
			<p><input type="submit" value="送信する"></p>
		</form>
	</body>
</html>