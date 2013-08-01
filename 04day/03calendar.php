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
//表示するカレンダの月を設定
if($_GET['num']==''){
	$today_year = date('Y');
	$today_month = date('n');
}else{
	$timestamp = mktime(0, 0, 0, date('n')+$_GET['num'], 1, date('Y'));
	$today_year = date('Y', $timestamp);
	$today_month = date('n', $timestamp);
	
}
//当月の最初の日（曜日）と最終日を決定
echo '$today_monthは'.$today_month;
$current = mktime(0, 0, 0, $today_month, 1, $today_year);

$first_day = date('w', $current);
$last_day = date('t', $current);
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
			print(date('Y年m月', $current)."のカレンダ");
			
			?>
		</h1>
		<table border="1" width="300">
			<tr><th>日</th><th>月</th><th>火</th><th>水</th><th>木</th><th>金</th><th>土</th>
			</tr>
			<?php
				for($i = 1; $i <= $first_day + $last_day; $i++){
					if($i % 7 == 1 ){
						print('<tr>');
					}
					if($i>$first_day){
						print('<td>'.($i-$first_day).'</td>');
					}else{
						print('<td>&nbsp;</td>');
					}
					if($i%7==0){
						print('</tr>');
					}
				}
			?>
		</table>
		<form method="POST" action="selectCalendar.php">
		
			<?php
				echo "<p>年を選択<br>";
				for($i=2013; $i<=2020; $i++){
					echo "<input type=\"radio\" name=\"selectYear\" value=\"".$i."\"> ".$i."年";
				}
				echo"<br>";
				echo "<p>月を選択<br>";
				for($i=1; $i<=12; $i++){
					echo "<input type=\"radio\" name=\"selectMonth\" value=\"".$i."\"> ".$i."月";
				}
				
			?>
			
			</p>
			<p><input type="submit" value="送信する"></p>
		</form>
	</body>
</html>