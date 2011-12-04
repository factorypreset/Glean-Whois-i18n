<?php
function safe_query($query="")
{
  if (empty($query)) {return FALSE;}
  $result=mysql_query($query)
  or die ("ack! query failed:"
  ."<li> errorno=".mysql_errno()
  ."<li> error=".mysql_error()
  ."<li> query=".$query);
  return $result;
}

function cleanup_text($value){
$value=strip_tags($value,"");
$value=htmlspecialchars($value);
return $value;
}

function print_states_select_box($id){
	echo "<select name='State' id='$id'>";
	echo "<option>----</option>";
	$result=safe_query("select * from school_ref group by State");
	while($row=mysql_fetch_array($result)){
		echo "<option >".$row['State']."</option>";	
	}
	echo "</select>";	
}


?>