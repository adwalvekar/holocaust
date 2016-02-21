<?php
include_once('dbcon.php');
if(isset($_POST['eventname'])&&isset($_POST['eventpasskey'])&&isset($_POST['data'])){
	$eventlabel= $_POST['eventname'];
	$eventpasskey=$_POST['eventpasskey'];
	$q= "SELECT * FROM events WHERE eventlabel = '$eventlabel' AND eventpasskey= '$eventpasskey'";
	$r = mysqli_query($link, $q);
	if ($r){
		if (mysqli_num_rows($r)==1){
			$data= $_POST['data'];
			$a=json_decode($data,true);
			$s="";
			$t="";
			$x=$a['fields'][0];
			$ar=$a['fields'];
			for($i=0;$i<sizeof($a['fields']);$i++){
				$ba=clean($a['fields'][$i]['name']);
				$t=$t.$ba;
				$ta=$a['fields'][$i]['value'];
				$s=$s."'".$ta."'";
				if(sizeof($a['fields'])-$i>1){
					$t=$t. ",";
				}				
				if(sizeof($a['fields'])-$i>1){
					$s=$s. ",";
				}
			}

			$q="INSERT INTO $eventlabel(id,$t) VALUES (default,$s)";

			$r=mysqli_query($link,$q);
			if($r){
				echo json_encode(array('status'=>true,'description'=>'YES.'));
			}else {echo json_encode(array('status'=>false,'description'=>'MYSQL Error'));}

		}else echo json_encode(array('status'=>false,'description'=>'No/Multiple events'));
		
	}else echo json_encode(array('status'=>false,'description'=>'Database Error'));

}else echo json_encode(array('status'=>false,'description'=>'No POST value set'));
function clean($string) {
   $string = str_replace(' ', '_', $string);
   return preg_replace('/[^A-Za-z0-9\_]/', '', $string);
}
mysqli_close($link);