<?php
 $connection=mysql_connect("localhost","USER_GOES_HERE","PASS_GOES_HERE")
 or die ("Couldn't connect to server");

 $db = mysql_select_db("plmlorg_DataAnalytics", $connection)
 or die ("Couldn'r select database");


?>
