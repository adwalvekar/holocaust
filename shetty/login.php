<?php
include_once('dbcon.php');
if (isset($_POST['password'])){
	$password=$_POST['password'];
	$q="SELECT * FROM admin WHERE password = '$password'";
	$r=mysqli_query($link, $q);
	if ($r){
		if(mysqli_num_rows($r)==1){
			session_start();
			$_SESSION['password']=$_POST['password'];
			echo json_encode(array('status'=>true,'description'=>"Logged In"));
		}else echo json_encode(array("status"=>false,'description'=>"Wrong Password"));

	}	

}
mysqli_close($link);
?>