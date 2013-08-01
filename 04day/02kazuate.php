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

$title = '数当てゲーム';
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
		<form method="POST" action="02kazuate.php">
			<input type ="text" name = "answer" size="5" maxlength="3" />
			<input type="submit" value="解答" />
		</form>
		<hr />
		<?php
		session_start();
			if(is_null($_SESSION['answer'])){
				$_SESSION['answer'] = mt_rand(1, 3);
				$_SESSION['game_cnt']=0;
							}
			
			if($_POST['answer']!=''){
			
				$_SESSION['game_cnt']++;
				print('現在の回数：'.$_SESSION['game_cnt']);
				
					if($_SESSION['answer']==$_POST['answer']){
						print('おめでとうございます！'.$_SESSION['game_cnt']. '回で正解しました。');
						session_destroy();
					}else{
						if($_SESSION['answer']>$_POST['answer']){
						print('もう少し大きいです。');
						}else{
						print('もう少し小さいです。');
						}
					}
			}
		?>
	</body>
</html>