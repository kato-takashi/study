<?php
//download.php
define('DOC_ROOT', './doc/');
$flag = FALSE;
$o_dir = opendir(DOC_ROOT);
while($file= readdir($o_dir)){
    if($file != '.'&& $file != '..'){}
        $filename = $file;
        $path = DOC_ROOT.$file;
        $file=mb_convert_encoding($file, 'UTF-8', 'JIS, eucjp-win, sjis-win');
        if($_GET['path']===$file){
            $flag = TRUE;
            break;
        }
    }
closedir($o_dir);
if(!$flag){
    die('不正なパスが指定されました');
    }
 header('Content-Type: application/octet-stream');
 header('Content-Disposition: attachment; filename='.$filename);
 print(file_get_contents($path));
