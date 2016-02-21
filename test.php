<?php
include_once('dbcon.php');
$a ='{"events":
[{"eventlabel":
"El_Chukso","form_data":{ "form_data": [{"type": "textbox","label": "Registration Number"},{"type": "checkbox","label": "Programming languages you know?","values": "C++,Java,Python"},{"type": "radiobutton","label": "Had sex with wally before?","values": "Yes,No"}, {"type": "radiobutton","label": "Member?","values": "Yes,No"}]}},{"eventlabel":"GBM","form_data":{"fields":[{"type":"textbox","label":"How is you?","placeholder":"asdsad"},{"type":"checkbox","label":"Wally?","values":"yes,no"}]}},{"eventlabel":"GBM2","form_data":{"fields":[{"type":"textbox","label":"How is you?","placeholder":"asdsad"},{"type":"checkbox","label":"Wally?","values":"yes,no"}]}},{"eventlabel":"Pretty","form_data":{"fields":[{"type":"textbox","label":"How is you?","placeholder":"asdsad"},{"type":"checkbox","label":"Wally?","values":"yes,no"}]}}]}';
// $a=stripslashes($a);
//echo $a;
$aa=json_decode($a,true);
echo sizeof($aa);
for($i=0;$i<sizeof($aa['fields']);$i++){
	$ar=$aa['fields'];
	echo $ar[$i]['values'];
}