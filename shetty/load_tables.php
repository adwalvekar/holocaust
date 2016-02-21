<?php
include_once('dbcon.php');
$q='SELECT eventlabel,form_data FROM events';
$r= mysqli_query($link, $q);
if ($r){
	$a=array();
	echo '{"events":';
	while($arr=mysqli_fetch_assoc($r)){
		array_push($a , $arr);
	}
 	echo json_encode($a);
 	echo '}';
}