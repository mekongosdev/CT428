<?php
// Kết nối CSDL
$db_host = "localhost"; // Ampps
$db_user = "root"; // Ampps
$db_pass = "mysql"; // Ampps
$db_name = "ltweb"; // Ampps
// $db_host = "172.30.35.70"; // Ltweb
// $db_user = "user_c4"; // Ltweb
// $db_pass = "puser_c4"; // Ltweb
// $db_name = "db_c4"; // Ltweb
$conn = mysql_connect($db_host,$db_user,$db_pass) or die(mysql_error());
mysql_select_db($db_name) or die("mysql can not find");
mysql_set_charset('utf8');
date_default_timezone_set('Asia/Ho_Chi_Minh');

?>
