<?php
$room_id = $_GET["room_id"];
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0">
<title>MEeTRO</title>
<style type="text/css" media="screen">
p {
  margin: 10px 5px;
  text-align: center;
}
</style>
</head>
<body>
<p>
<a href="railway://meetro/?room_id=<?php echo $room_id?>">招待された部屋に入る</a>
</p>
<p>
<a>MEeTROをダウンロードする(工事中)</a>
</p>
</p>
</body>
</html>
