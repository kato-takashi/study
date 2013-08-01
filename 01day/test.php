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

$title = 'みなさんこんにちわ!';
$names = array('高江', '和田', '長田', '森山', '横塚',);
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
			<?php
			for($i=0; $i<count($names); $i++){
				print("<p>こんにちわ".$names[$i]."さん!</p>");
			}
			?>
	</body>
</html>