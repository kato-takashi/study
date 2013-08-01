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

require_once './encode.php';
$title='ゲストブック（閲覧）';
?>
<html>
<head>
<title><?php echo $title;?></title>
</head>
<body>
<h1><?php echo $title;?></h1>
<?php 
	$doc = simplexml_load_file('guest.xml');
	//print_r($doc);
	foreach($doc->data as $data){
?>
<ol>
	<li>お名前: <?php e($data->name);?></li>
	<li>メッセージ: <?php e($data->message);?></li>
	<li>書き込み日時: <?php e($data['updated']);?></li>
</ol>
<?php
	}
?>
</body>
</html>
