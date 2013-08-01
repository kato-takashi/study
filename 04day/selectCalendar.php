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

$title = '万年カレンダー';
//////ここから///////
if(isset($_POST["selectMonth"]) && isset($_POST["selectYear"])){
//echo "選択は".$_POST['selectYear']."<br>";
//echo "選択は".$_POST['selectMonth'];
	$selectYear = $_POST['selectYear'];
	$selectMonth = $_POST['selectMonth'];
}else{
echo'年もしくは月に選択がありません<br>';
		
		$selectYear = date("Y");
		$selectMonth = date('n');
		
}

		$today_year = $selectYear;
		$today_month = $selectMonth;

//当月の最初の日（曜日）と最終日を決定
$current = mktime(0, 0, 0, $today_month, 1, $today_year);

$first_day = date('w', $current);
$last_day = date('t', $current);

include 'calendarHtml/calendar.html';
?>