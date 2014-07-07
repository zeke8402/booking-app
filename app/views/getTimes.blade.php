<?php

// Simply pushing each row from the DB into the array
$jsonArr = array();
foreach($availableTimes as $t):
  array_push($jsonArr, $t);
endforeach;

// Encode as json for AJAX
print_r(json_encode($jsonArr));
//print_r('package time: '.$packageTime);
//print_r($endTime);
?>