<html>
<head>
  <title>WhatHappend Stats</title>
  </head>
<body>
<center>
  <h1>WhatHappend Stats as of current date.</h1>
<?php

$link = mysql_connect("localhost", "root", "WhatHappendPWD.");
mysql_select_db("whathappend", $link);

$result = mysql_query("SELECT * FROM users", $link);
$num_rows = mysql_num_rows($result);

echo "<h2>Total number of users: $num_rows Rows <br></h2>";


$result2 = mysql_query("SELECT * FROM posts", $link);
$num_rows = mysql_num_rows($result2);

echo "<h2>Total number of posts: $num_rows Rows <br></h2>";



$result3 = mysql_query("SELECT * FROM posts where reports > 0", $link);
$num_rows = mysql_num_rows($result3);

echo "<h2>Total number of reported posts: $num_rows Rows <br></h2>";


?>
</center>
</body>
</html>