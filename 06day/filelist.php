<?php require_once '../Encode.php'; ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8" />
<title>PHP入門教室</title>
</head>
<body>
<h3>ファイルリスト</h3>
<table border="1">
<tr>
  <th>ファイル</th><th>サイズ</th><th>最終アクセス日</th><th>最終更新日</th>
</tr>
<?php
const DOC_ROOT = '../doc/';
clearstatcache();
$o_dir = @opendir(DOC_ROOT)
  or die('フォルダが開けませんでした。');
while ($file = readdir($o_dir)) {
  if (is_file(DOC_ROOT.$file)) {
    $path = DOC_ROOT.$file;
    $file = mb_convert_encoding($file, 'UTF-8', 'SJIS-WIN');
?>
    <tr>
      <td><a href="download.php?path=<?php print(urlencode($file)); ?>">
        <?php print(e($file)); ?></a></td>
      <td><?php print(round(filesize($path) / 1024)); ?>KB</td>
      <td><?php print(date('Y/m/d H:i:s', fileatime($path))); ?></td>
      <td><?php print(date('Y/m/d H:i:s', filemtime($path))); ?></td>
    </tr>
<?php
  }
}
closedir($o_dir);
?>
</table>
</body>
</html>
