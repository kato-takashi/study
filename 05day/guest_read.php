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

$title = 'ゲストブック 閲覧';
require_once 'php10/Encode.php';
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
			print($title."（閲覧）"); 
			?>
		</h1>
		<?php
		$file = fopen('guest.dat', 'rb');
		flock($file, LOCK_SH);
		while($row = fgetcsv($file, 1024, "\t")){
			?>
			<ol>
			<li>お名前：<?php e($row[1]) ?> </li>
			<li>メッセージ：<?php e($row[2]) ?> </li>
			<li>書き込み日時：<?php e($row[0]) ?> </li>
			</ol>
			<hr />
		<?php
		}
		fclose($file);
		?>
		
	</body>
</html>