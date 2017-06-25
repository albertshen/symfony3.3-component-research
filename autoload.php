<?php

spl_autoload_register('test');

// class AAB
// {
	
// }

function test($class)
{
	var_dump($class);
	include dirname(__FILE__).'/'.$class.'.php';
}

$a = new AAB();

$b = new AAB();