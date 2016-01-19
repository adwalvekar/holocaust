<?php
include_once('dbcon.php');
session_start();
if (isset($_SESSION['password'])){
	if(isset($_POST['eventlabel'])&&isset($_POST['eventpasskey'])&&isset($_POST['form_data'])){
		$eventlabel= $_POST['eventlabel'];
		$password=$_POST['eventpasskey'];
		$form_data=$_POST['form_data'];
		$q= "SELECT * FROM events WHERE eventlabel ='$eventlabel'";
		$r= mysqli_query($link , $q);
		if($r){
			if(mysqli_num_rows($r)>=1){
				echo json_encode(array('status'=>false,'description'=>'Event you are trying to make already exists. Please choose a different name or Scrap the event. Fool.'));
			}
			else{
				$q = "INSERT INTO  events  VALUES ('$eventlabel','$password','$form_data');";
				$r= mysqli_query($link,$q);
				$s = $_POST['form_data'];
				$json = json_decode($s,true);
				if($json!=NULL){
					$content=$json['form_data'];
					$z='';
					$s='';
					for($i=0;$i<sizeof($content);$i++){
						switch ($content[$i]['type']) {
							case 'textbox':
							$label=clean($content[$i]['label']);
							$e=$label. " VARCHAR(255)";
							$s = $s . $e;
							if(sizeof($content)-$i>1){
								$s=$s. ",";
							}
							break;
							case 'checkbox':
							$x= str_getcsv($content[$i]['values']);
							for($y=0;$y<sizeof($x);$y++){
								$z=$z."'$x[$y]'";
								if(sizeof($x)-$y>1){
									$z=$z. ",";
								}

							}
							$label=clean($content[$i]['label']);
							$s = $s .$label. " ENUM($z) ";
							if(sizeof($content)-$i>1){
								$s=$s. ",";
							}
							break;
							case 'radiobutton':
							$label=clean($content[$i]['label']);
							$s = $s . $label. " ENUM('yes','no')";
							if(sizeof($content)-$i>1){
								$s=$s. ",";
							}
							break;

						}
						
					}
					$q="CREATE TABLE $eventlabel ($s);" ;
					$r=mysqli_query($link,$q);
					if ($r){
						echo json_encode(array('status'=>true,'description'=>"Done"));	
					}
				}

				else{
					echo json_encode(array('status'=>false,'description'=>"The JSON you sent has an error. Damn it Shetty."));
				}
			}
		}
		else{
			echo json_encode(array('status'=>false,'description'=>"Couldn't connect to Database"));
		}
		
	}
} 
else {
	echo json_encode(array('status'=>false,'description'=>'Error in Authentication: Login First.'));
}
function clean($string) {
   $string = str_replace(' ', '_', $string); // Replaces all spaces with hyphens.
   $string=strtolower($string);
   return preg_replace('/[^A-Za-z0-9\_]/', '', $string); // Removes special chars.
}
?>