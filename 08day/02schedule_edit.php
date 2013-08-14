<?php
/*
サービス公開時とそうでない時で記述をいちいち書き換えるのは面倒な上にミスの元なので、極力最小の労力で設定が書き換わるようにしておくのが望ましい。以下はURLがlocalhostか否かで設定を切り替える例。
*/
$title= '簡易スケジュール帳';
require_once('../../00common_func/htmlESC.php');
require_once('../../00common_func/date_fromat.php');

$is_develop = $_SERVER['HTTP_HOST'] === 'localhost';
if($is_develop){
  error_reporting(E_ALL);
  ini_set('display_errors', '1');
}else{
  error_reporting(E_ALL ^ E_NOTICE);
  ini_set('display_errors', '0');
  }
/**************/

function showOption($start, $end, $default, $step=1){
	for($i=$start; $i<=$end; $i += $step){
		print('<option value="'.$i.'"');
		if($i==$default){
			print('selected');
		}
		print('>'.$i.'</option>');
	}
}

try{
	$db = new PDO('mysql:host=localhost;dbname=10daysPHP', 'phpusr', 'taka4');
	$db->exec('SET NAMES utf8');
}catch(PDOEXception $e){
	die('エラーメッセージ：'.$e->getMessage());
}

$stt= $db->prepare('SELECT * FROM schedule WHERE sid =:sid');
$stt->bindValue(':sid', $_GET['sid']);
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
		
		<?php if ($row = $stt->fetch(PDO::FETCH_BOTH)){
				$sdate = strtotime($row['sdate']);
				$stime = strtotime($row['stime']);
		?>
			<form method ="POST" action="02schedule_update.php">
				<input type="hidden" name="sid" value="<?php print($row['sid']);?>">
				<p>
					予定名：<br />
					<input type="text" name="title" size="50" maxlength="255" value="<?php print($row['title']);?>">
				</p>
				<p>
					日付：<br />
					<select name="sdate_year"><?php showOption(2013, 2020, date('Y', $sdate));?></select>年
					<select name="sdate_month"><?php showOption(1, 12, date('n', $sdate));?></select>月
					<select name="sdate_day"><?php showOption(1, 31, date('j', $sdate));?></select>日
				</p>
				<p>
					<select name="sdate_hour"><?php showOption(0, 23, date('G', $sdate));?></select>時
					<select name="sdate_minute"><?php showOption(0, 59, date('i', $sdate));?></select>分
				</p>
				<p>
					備考：<br />
					<input type="text" name="memo" size="70" maxlength="255" value="<?php print($row['memo']);?>">
				</p>
				<p>
					<input type="submit" name="update" value="更新">
					<input type="submit" name="delete" value="削除">
				</p>
			</form >
		<?php }else{
			print('該当するデータがありません。');
		} ?>
	</body>
</hmtl>