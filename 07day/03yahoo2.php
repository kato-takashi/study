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
require_once 'encode.php';
$title = 'サイト検索結果';
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
			<dl>
			<?php
				$params = array(
				//yahooAPI アプリケーションID
					'appid'=>'dj0zaiZpPU1tRlpSTUJ1SVVuSCZkPVlXazlVR3BCVFZSSE5uVW1jR285TUEtLSZzPWNvbnN1bWVyc2VjcmV0Jng9MjM-',
					'site'=>'codezine.jp',
					'query'=>$_POST['keywd']
				);
				
				
				$doc = simplexml_load_file('http://api.search.yahoo.co.jp/WebSearchService/V1/webSearch?appid=<dj0zaiZpPU1tRlpSTUJ1SVVuSCZkPVlXazlVR3BCVFZSSE5uVW1jR285TUEtLSZzPWNvbnN1bWVyc2VjcmV0Jng9MjM->&query=%E3%81%82&start=1&results=10');
				
				var_dump($doc);
				exit;
								?>
			</dl>
	</body>
</html>