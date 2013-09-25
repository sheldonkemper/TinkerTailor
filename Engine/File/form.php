<!doctype html>
<html>
<head>
    <title></title>
</head>
<body>
    <!--Form available for testing purposes-->
<form action="upload.php" method="post" enctype="multipart/form-data">
  Send these files:<br />
  <input type="hidden" name="<?php echo ini_get("session.upload_progress.name"); ?>" value="123" />
  <input name="userfile" type="file" /><br />
  <input type="submit" value="Send files" />
</form>
</body>
</html>
