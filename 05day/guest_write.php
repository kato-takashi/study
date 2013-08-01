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

$file = fopen('guest.dat', 'ab');
flock($file, LOCK_EX);
$line = date('Y年m月d日 H:i:s')."\t";
$line .= $_POST['name']."\t";
$line .= $_POST['message']."\t";
fputs($file, $line."\n");
fclose($file);
header('Location: http://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']).'/guest_input.php');
//サーバが変わってもOKなアドレス
//Location: http://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']).'/hoge.php
/*//リダイレクト処理
header('Location: https://www.google.co.jp/');
*/
?>