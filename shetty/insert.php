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
			$ar=json_decode($a['fields']);
			for($i=0;$i<sizeof($ar);$i++){
				$t=$t.$ar[$i]->name;
				$s=$s."'".$ar[$i]->value."'";

				if(sizeof($a)-$i>=0){
					$t=$t. ",";
				}				
				if(sizeof($a)-$i>=0){
					$s=$s. ",";
				}
			}
			$q="INSERT INTO $eventlabel(id,$t) VALUES (default,$s)";

			$r=mysqli_query($link,$q);
			if($r){
				echo json_encode(array('status'=>true,'description'=>'YES.'));
			}else echo json_encode(array('status'=>false,'description'=>'NOPE.'));

		}else echo json_encode(array('status'=>false,'description'=>'No/Multiple events'));
		
	}else echo json_encode(array('status'=>false,'description'=>'Database Error'));

}else echo json_encode(array('status'=>false,'description'=>'No POST value set'));