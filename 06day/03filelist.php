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

require_once './03encode.php';
$title='ファイルのリスト';
?>
<html>
<head>
<title><?php echo $title;?></title>
</head>
<body>
<h1><?php echo $title;?></h1>
<table>
<tr>
<th>ファイル</th>
<th>サイズ</th>
<th>最終アクセス日</th>
<th>最終更新日</th>
</tr>
<?php
define('DOC_ROOT', './doc/');
clearstatcache();
$o_dir = opendir(DOC_ROOT);
while($file=readdir($o_dir)){
//var_dump($file);
    if(is_file(DOC_ROOT.$file)){
        $path=DOC_ROOT.$file;
        $file=mb_convert_encoding($file, 'UTF-8', 'JIS, eucjp-win, sjis-win');
        var_dump($file);
?>
<tr>
<td><a href="03download.php?path=<?php print(urlencode($file)); ?>">
<?php e($file);
?>
</a>
</td>
<td>test<?php print(round(filesize($path)/1024));?>KB</td>
<td><?php print(date('Y/m/d H:i:s', fileatime($path)));?></td>
<td><?php print(date('Y/m/d H:i:s', fileatime($path)));?></td>                 
</tr>
<?php
    }
}

closedir($o_dir);
?>
</table>
</body>
</html>
