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

$title = 'クッキーでデータを記録する';
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
		<form method="POST" action="cookie_rec.php">
		メールアドレス：
		<input type="text" name="e-mail" size="30" maxlength="50" value="<?php print($_COOKIE['e-mail']);?>"/>
		<input type="submit" value="送信"/>
		</form>
	</body>
</html>