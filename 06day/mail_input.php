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

$title = '10日で覚えるPHP入門教室（アンケート）';
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
		
		<form method="POST" action="sendmail.php">
			<p>名前：<br />
			<input type="text" name="name" size="20" mazlength="30" />
			</p>
			<p>メールアドレス：<br />
			<input type="text" name="form" size="50" mazlength="255" />
			</p>
			<p>自由記入欄：<br />
			<textarea name="memo" cols="50" rows="5"></textarea>
			</p>
			<p><input type="submit" value="送信"></p>
		</form>
	</body>
</html>