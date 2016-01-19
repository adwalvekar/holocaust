<?php
include_once('dbcon.php');
$q='SELECT eventlabel FROM events';
$r= mysqli_query($link, $q);
if ($r){
	$a=array();
	echo '{"events":';
	while($arr=mysqli_fetch_array($r)){
		array_push($a , $arr['eventlabel']);
	}
 	echo json_encode($a);
 	echo '}';
}