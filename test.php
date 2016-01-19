<?php
$s = '{"events":["yes","yesaa","yesaadd","yesaadddd"]}';
$j=json_decode($s,true);
print_r($j['events']);