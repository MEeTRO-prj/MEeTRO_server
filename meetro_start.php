<?php
$room_id = $_GET["room_id"];
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>アプリケーション起動サンプル</title>
</head>
<body>
<a href="railway://meetro/?room_id=<?php echo $room_id?>">アプリケーションを起動</a>
</body>
</html>
