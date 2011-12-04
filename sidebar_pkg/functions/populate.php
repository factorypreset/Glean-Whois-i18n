<?php 
require_once("../dbconnect.php");
require_once("functions.php");

$state = $_REQUEST['state'];
$selectid = $_REQUEST['selectid'];

$result=safe_query("select * from district_ref where State='".$state."' group by County_Name");
echo "<select name='District' id=\"$selectid\" style='width:200px'>";

echo "<option value=''>-- None --</option>";

while($row = mysql_fetch_assoc($result)){
	echo "<option value='".$row['SFID'].":".$row['NCESDistId']."' title='".$row['County_Name']."'>";
	echo $row['County_Name'];
	echo "</option>";		
}
echo "</select>";



?>