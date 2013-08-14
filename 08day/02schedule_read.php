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
$title= '簡易スケジュール帳';
require_once('../../00common_func/htmlESC.php');
require_once('../../00common_func/date_fromat.php');
//echo h('test');
try{
	$db = new PDO('mysql:host=localhost; dbname=10daysPHP', 'phpusr', 'taka4');
	$db->exec('SET NAMES utf8');
}catch(PDOException $e){
	die('エラーメッセージ：'.$e->getMessage());
}
$stt = $db->prepare('SELECT * FROM  schedule ORDER BY sdate, stime');
$stt->execute();
?>

<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta chraset = 'UTF-8' />
		<title><?php echo h($title);?></title>
	</head>
	<body>
		<h1><?php echo h($title);?></h1>
		<table border="1">
			<tr><th>ID</th><th>日付</th><th>時刻</th><th>予定名</th><th>備考</th><th></th>
			</tr>
		<?php while ($row = $stt->fetch(PDO::FETCH_ASSOC)){?>
			<tr>
				<td><?php echo h($row['sid']);?></td>
				<td><?php _date_format($row['sdate'], 'Y/m/d');?></td>
				<td><?php _date_format($row['stime'], 'H:i');?></td>
				<td><?php echo h($row['title']);?></td>
				<td><?php echo h($row['memo']);?></td>
				<td><a href="02schedule_edit.php?sid=<?php echo h($row['sid']);?>">編集</a></td>
			</tr>
		<?php } ?>

		</table>
	</body>
</hmtl>