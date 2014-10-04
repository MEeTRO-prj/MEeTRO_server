<?php
include_once './Config.php';

$link = mysql_connect(DB_HOST, DB_USERNAME, DB_PASSWORD);
mysql_query("SET CHARACTER SET utf8");
mysql_select_db(DB_NAME, $link);
?>