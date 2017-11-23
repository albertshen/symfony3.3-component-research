<?php

$a = array('a', 'b'); 
$b = array('a', 'bc', 'd'); 
$c = $a + $b; 
var_dump($c); 
var_dump(array_merge($a, $b)); 