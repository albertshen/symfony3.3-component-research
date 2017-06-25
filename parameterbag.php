<?php

require_once __DIR__.'/vendor/autoload.php';

use Symfony\Component\DependencyInjection\ParameterBag\EnvPlaceholderParameterBag;

$env = new EnvPlaceholderParameterBag();

$a = $env->get('env(33)');
//var_dump($a);
//
$a = array('a', 'b'); 
$b = array('a', 'bc', 'd'); 
$c = $a + $b; 
var_dump($c); 
var_dump(array_merge($a, $b)); 