<?php

function albert()
{
	throw new \RuntimeException('alberttttt');
	echo 'albee';
}

function anke()
{
	try {
		albert();
	} catch (\RuntimeException $e) {
		throw $e;
	} catch (\Exception $e) {
		var_dump($e->getMessage());
	}
	throw new \Exception('aaaaa');
	echo 'anke';
}

// anke();
try {
	anke();
} catch (\RuntimeException $e) {
	var_dump('runtime'.$e->getMessage());
} catch (\Exception $e) {
	var_dump($e->getMessage());
} finally {
	echo '333';
}

echo 'albert';
exit;