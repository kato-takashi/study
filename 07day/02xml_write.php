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

$doc = simplexml_load_file('guest.xml');
$data = $doc->addChild('data');
$data->addChild('name', $_POST['name']);
$data->addChild('message', $_POST['message']);
$data->addAttribute('updated', date('Y年m月d日 H:i:s'));
$doc->asXML('guest.xml');
//var_dump($doc);
header('Location: http://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']).'/xmllist.php');