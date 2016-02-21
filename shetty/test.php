<?php
include_once('dbcon.php');
$q="SELECT * FROM events WHERE eventlabel ='GBM'";
$r=mysqli_query($link,$q);
$arr=mysqli_fetch_assoc($r);
echo $arr['form_data'];