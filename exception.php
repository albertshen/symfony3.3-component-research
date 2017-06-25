<?php

function tripleInteger($int)
{
  //throw new RuntimeException('shenhaodong');
  if(!is_int($int))
    throw new InvalidArgumentException('tripleInteger function only accepts integers. Input was: '.$int);
	echo '3333';
  return $int * 3;
}


try {
	$x = tripleInteger('d');
} catch (InvalidArgumentException $e) {
	var_dump($e->getMessage());
} catch (RuntimeException $e) {
	var_dump($e->getMessage());
} catch (BadFunctionCallException $e) {
	var_dump($e->getMessage().'bbb');
} catch (Exception $e) {
	var_dump($e->getMessage().'aaaaaa');
} finally {
	echo 'finally';
}

var_dump(234234);
// $x = tripleInteger(4); //$x == 12
// $x = tripleInteger(2.5); //exception will be thrown as 2.5 is a float
// $x = tripleInteger('foo'); //exception will be thrown as 'foo' is a string
// $x = tripleInteger('4'); //exception will throw as '4' is also a string
// 
//var_dump($x);


// function exception_error_handler($severity, $message, $file, $line) {
//     if (!(error_reporting() & $severity)) {
//         // This error code is not included in error_reporting
//         return;
//     }
//     throw new ErrorException($message, 0, $severity, $file, $line);
// }
// set_error_handler("exception_error_handler");

// /* Trigger exception */
// try {
// 	strpos();
// } catch (ErrorException $e) {
// 	var_dump($e->getMessage());
// 	var_dump($e->getCode());
// 	var_dump($e->getFile());
// 	var_dump($e->getLine());
// }
// 

