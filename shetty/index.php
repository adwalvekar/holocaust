<?php
$a=scandir('/var/www/html/holocaust/');

for($i=0;$i<sizeof($a);$i++) {
	echo $a[$i];
	echo '<br>';
}
?>