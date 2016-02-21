<?php
include('dbcon.php');
if(isset($_POST['eventlabel'])&&isset($_POST['eventpasskey'])){
	$eventlabel= $_POST['eventlabel'];
	$eventpasskey= $_POST['eventpasskey'];
	$q = "SELECT eventlabel FROM events WHERE eventlabel='$eventlabel' AND eventpasskey = '$eventpasskey'";
	$r= mysqli_query($link , $q);
	if($r){
		if(mysqli_num_rows($r)==1){
			$q="SELECT * FROM $eventlabel";
			$dave= mysqli_query($link,$q);
			$f=mysqli_num_rows($dave);
			echo '{"data":[';
			while($row = mysqli_fetch_assoc($dave)){
				echo json_encode($row);
				$f--;
				if($f>0)echo ',';

			}
			echo "]}";
		}else echo json_encode(array("status"=>"false","description"=>"No event with that name"));
	}else echo json_encode(array("status"=>"false","description"=>"SQL Error"));
}else echo json_encode(array("status"=>"false","description"=>"No Data Recieved"));
mysqli_close($link);