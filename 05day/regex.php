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

$title = '正規表現によるデータ検索';
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
		$file=fopen('data.dat', 'r');
		while($row = fgets($file, 1024)){
			print(preg_replace('|http(s)?://([\w]+\.)+[\w-]+(/[\w- ./?%&=]*)?|i', '<a href="\0">\0</a>', $row).'<br />');
			/*
			if(preg_match_all('|http(s)?://([\w]+\.)+[\w-]+(/[\w- ./?%&=]*)?|i', $row, $data) !==0 ){
				foreach($data[0] as $match){
					print($match.'<br />');
				}
				//print('<a href=" '.$data[0].' ">'.$data[0].'</a>'.'<br />');
				//print_r($data);
			}
			*/
		}
		fclose($file);
		?>
	</body>
</html>