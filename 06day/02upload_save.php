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

$error_flag = true;
$up_file = $_FILES['upload_file']['tmp_name'];
define('UP_FOLDER', './doc/');
$save_path = mb_convert_encoding(UP_FOLDER.$_FILES['upload_file']['name'], 'SJIS-WIN', 'UTF-8');

if($_FILES['upload_file']['error'] !== 0){
	switch($_FILES['upload_file']['error']){
		case UPLOAD_ERR_INI_SIZE:
		$error_msg='php.iniのupload_max_filesize制限を超えています。';
		break;
		
		case UPLOAD_ERR_FORM_SIZE:
		$error_msg='HTMLのMAX_FILE_SIZE制限を超えています。';
		break;
		
		case UPLOAD_ERR_PARTIAL:
		$error_msg='ファイルが一部しかアップロードされていません。';
		break;
		
		case UPLOAD_NO_FILE:
		$error_msg='ファイルがはアップロードされませんでした。';
		break;
		
		default:
		$error_msg='不明なエラーです。';
		break;
	}
}elseif( !is_uploaded_file($up_file)){
	$error_msg= '不正な操作が行われた可能性があります。';
}elseif(strpos($_FILES['upload_file']['type'], 'image/') !==0){
	$error_msg='画像以外はアップロードできません。';
}else{
	$err_flag= FALSE;
}
if($error_flag){
	print('<div style="color:Red">'.$error_msg.'</div>');
}else{
	move_uploaded_file($up_file, $save_path);
	header('Location:http://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'].'02upload.php'));
}
