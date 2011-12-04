<?php 
require_once("../dbconnect.php");
require_once("functions.php");

$districtinfo = explode(":", $_REQUEST['district']);

$disctrict_id = $districtinfo[1];

$result=safe_query("select * from school_ref where NCESDistId='".$disctrict_id."' ");
$row=mysql_fetch_array($result);
$district=$row['County_Name']; 

$selectid = $_REQUEST['selectid'];

$result=safe_query("select * from school_ref where County_Name='".$district."' group by School_Name");
echo "<select name='School' id=\"$selectid\" style='width:200px'>";


echo "<option value='' >-- None --</option>";

while($row=mysql_fetch_assoc($result)){
	echo "<option value='".$row['SFID']."' title='".$row['School_Name']."'>";
	echo $row['School_Name'];
	echo "</option>";		
}
echo "</select>";


?>
