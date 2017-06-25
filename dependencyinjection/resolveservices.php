<?php

require_once __DIR__.'/../vendor/autoload.php';

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBag;
use Symfony\Component\DependencyInjection\Argument\ServiceClosureArgument;
use Symfony\Component\DependencyInjection\Argument\IteratorArgument;

class Test
{
	private $value;

	private $ref;

	private $iterator;

	public function __construct($value, $ref, $iterator)
	{
		$this->value = $value;
		$this->ref = $ref();
		$this->iterator = $iterator;
	}

	public function getValue()
	{
		return $this->value;
	}

	public function printValue($v)
	{
		$this->ref->printValue($v);
	}
}

class TestReference
{
	public function printValue($value)
	{
		echo $value;
	}
}

class TestReference2
{
	public function printValue($value)
	{
		echo $value.'2';
	}
}

$parameter = new ServiceClosureArgument(new Reference('srv.reference'));
$iterator = new IteratorArgument(array(new Reference('srv.reference'), new Reference('srv.reference2')));


$container = new ContainerBuilder();
$container->setParameter('id', 'aaaa');
$container->setParameter('ref', $parameter);
$container->setParameter('iterator', $iterator);

$container
	->register('srv.reference', 'TestReference');
$container
	->register('srv.reference2', 'TestReference2');
$container
	->register('srv.configurator', 'Configurator');

$container
	->register('srv.test', 'Test')
	->addArgument('%id%')
	->addArgument('%ref%')
	->addArgument('%iterator%');

$test = $container->get('srv.test');

$test->printValue('aaallllbbb');

exit;
