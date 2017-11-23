<?php

require_once __DIR__.'/vendor/autoload.php';

use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\EventDispatcher\Event;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\EventDispatcher\ContainerAwareEventDispatcher;

class AlbertEvent extends Event
{
	private $count = 0;

	public function addCount($num)
	{
		$this->count += $num;
	}

	public function minCount($num)
	{
		$this->count -= $num;
	}

	public function getCount()
	{
		var_dump($this->count);
	}
}

class AListener
{
	public function onFooAction($event, $eventName, $obj)
	{
		$event->addCount(11);
		$event->getCount();
		$event->stopPropagation();
	}
}

class BListener
{
	public function onFooAction($event, $eventName, $obj)
	{
		$event->minCount(4);
		$event->getCount();
	}
}
/*******    ContainerAwareEventDispatcher    ******/

// $container = new ContainerBuilder();
// $container->register('listenera', 'AListener');
// $container->register('listenerb', 'BListener');

// $dispatcher = new ContainerAwareEventDispatcher($container);

// $dispatcher->addListenerService('test.a', array('listenera', 'onFooAction'));
// $dispatcher->addListenerService('test.a', array('listenerb', 'onFooAction'));


/*******    EventDispatcher    ******/

// $dispatcher = new EventDispatcher();

// $alistener = new AListener();
// $blistener = new BListener();

// $dispatcher->addListener('test.a', array($alistener, 'onFooAction'), 100);
// $dispatcher->addListener('test.a', array($blistener, 'onFooAction'), 101);
// $dispatcher->addListener('test.b', array($listener, 'onFooAction'), 1);

// $event = new AlbertEvent();
// $dispatcher->dispatch('test.a', $event);


/*******    EventDispatcher Closure   ******/

$dispatcher = new EventDispatcher();

$alistener = new AListener();
$blistener = new BListener();

$dispatcher->addListener('test.a', array($alistener, 'onFooAction'), 100);
$dispatcher->addListener('test.a', array(function() use ($blistener){
	return $blistener;
}, 'onFooAction'), 101);

$event = new AlbertEvent();
$dispatcher->dispatch('test.a', $event);
