<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8" />
<title>PHP入門教室</title>
</head>
<body>
<h3>ファイルのアップロード</h3>
<form method="post" action="upload_process.php"
  enctype="multipart/form-data">
  <input type="hidden" name="max_file_size" value="1000000" />
  <input type="file" name="upfile" size="50" />
  <input type="submit" value="アップロード" />
</form>
</body>
</html>
