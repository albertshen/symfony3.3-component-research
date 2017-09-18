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

class Wechat
{
	private $subscribers = array();

	public function register(Subscriber $subscriber)
	{
		$this->subscribers[] = $subscriber;
	}

	public function pushMessage($message)
	{
		foreach($this->subscribers as $subscriber)
		{
			$subscriber->getMessage($message);
		}
	}
}

interface Subscriber
{
	public function getMessage($message);
}

class Evelin implements Subscriber
{
	public function getMessage($message)
	{
		echo 'Evelin: '. $message;
	}
}

class Anke implements Subscriber
{
	public function getMessage($message)
	{
		echo 'Anke: '. $message;
	}
}

$wechat = new Wechat();
$evelin = new Evelin();
$anke = new Anke();

$wechat->register($evelin);
$wechat->register($evelin);
$wechat->pushMessage('发新消息啦！');
exit;
class Test
{
	public $before = array();

	public function before()
	{
	    return $this->before[] = 'albertshen';
	}

	public function getBefore()
	{
	    return $this->before;
	}

}


// $student = new Student('Albert');

// $redshoe = new RedShow($student);

// $redshoe = new GreeHat($redshoe);

// $redshoe->show();

// $t = new Test();
// var_dump($t->before());
// var_dump($t->getBefore());

// var_dump($b = $t->before[] = 0);
// var_dump($t->before);
// var_dump($b);
function tt()
{
	if(date('Y-m-d H:i:s') > '2017-06-14 07:56:32') {
		return false;
	}
	return date('Y-m-d H:i:s');
}

while($a = tt())
{
	var_dump($a);
	sleep(1);
}




