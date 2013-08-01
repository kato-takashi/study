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

$title = 'おみくじ';
$omikuji = array('大吉', '中吉', '小吉', '吉', '凶');
$coments = array(
'大吉' => 'ラッキー今日は超ハッピー!!',
'中吉' => '今日も元気!',
'小吉' => '小さな幸せ',
'吉' => '今日も無難に',
'凶' => 'おとなしく過ごしましょう'
);
shuffle($omikuji);
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
			print($title.' 今日の運勢');
			?>
		</h1>
		<h2>
		<?php 
		print($omikuji[0].'<br>');
		print($coments[$omikuji[0]]);
		?>
		</h2>
	</body>
</html>