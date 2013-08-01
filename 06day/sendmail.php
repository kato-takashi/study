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

$ini = parse_ini_file('mail.ini');
$if(!preg_match('/^\w+([-+.\']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/ID', $_POST['form'])){
	die('不正なメールアドレスです。');
}

$headers = <<<HEAD
From: {$_POST['form']}
Return-path: {$_POST['form']}
Content-Type: text/plain;charset=UTF-8
HEAD;

$body="■■{$ini['subject']}■■\n\n";
foreach($_POST as $key => $value){
	$body .= "[{$key}]{$value}\n";
}
mb_send_mail($ini['mailto'], $ini['subject'], $body, $headers);

header('Location: '.$ini['dist']);