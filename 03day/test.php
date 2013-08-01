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

$title = 'クリエ情報を取得する';
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
			<?php 
				switch($_GET['category']){
					case 'PHP':
							$result="関数主体の手軽に使えるサーバサイド技術です。";
						break;
					case 'JSP':
							$result="Javaベースの高機能なサーバサイド技術です。";
						break;
					case 'ASP':
							$result="Windowsの代表的なサーバサイド技術です。";
						break;
					default:
							$result="クリエ情報categoryを指定してください。";
						break;
				}
			?>
		<h1>
			<?php 
			print($title);
			?>
		</h1>
		<?php
		print($result);
		?>
	</body>
</html>