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

$title = '簡易スケジュール帳';

function showOption($start, $end, $step=1){
	for($i=$start; $i<=$end; $i+=$step){
		print('<option value="'.$i.'">'.$i.'</option>');
	}
}

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
		
		<form method="POST" action="01schedule_record.php">
		<p>
			予定名：<by />
			<input type="text" name="title" size="50" maxlength="255" /><br/>
		</p>
		<p>
			日付：<by />
			<select name="sdate_year"><?php showOption(2013, 2020);?></select>年
			<select name="sdate_month"><?php showOption(1, 12);?></select>月
			<select name="sdate_day"><?php showOption(1, 31);?></select>日
		</p>
		<p>
			開始時間：<by />
			<select name="stime_hour"><?php showOption(0, 23);?></select>時
			<select name="stime_minute"><?php showOption(0, 59, 15);?></select>分
		</p>
		<p>
			備考：<by />
			<input type="text" name="memo" size="50" maxlength="255" /><br/>
		</p>
		<p>
			<input type="submit" value="登録"/>
		</p>
		</form>
	</body>
</html>