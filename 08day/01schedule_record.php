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

try{
	$db = new PDO('mysql:host=localhost;dbname=10daysPHP', 'phpusr', 'taka4');
	$stt = $db->prepare('INSERT INTO schedule(title, sdate, stime, memo) VALUES(:title, :sdate, :stime, :memo)');
	$stt->bindValue(':title', $_POST['title']);
	$stt->bindValue(':sdate', $_POST['sdate_year'].'/'.$_POST['sdate_month'].'/'.$_POST['sdate_day']);
	$stt->bindValue(':stime', $_POST['stime_hour'].':'.$_POST['stime_minute']);
	$stt->bindValue(':memo', $_POST['memo']);
	$stt->execute();
	$db=NULL;
	
}catch(PDOException $e){
	die('エラーメッセージ：'.$e->getMessage());
}
//var_dump('http://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']).'/01schedule_form.php');
header('Location: http://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']).'/01schedule_form.php');
//echo 'success!';
