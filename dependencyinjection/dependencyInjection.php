<?php

require_once __DIR__.'/vendor/autoload.php';

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBag;
use Symfony\Component\DependencyInjection\Argument\ServiceClosureArgument;
use Symfony\Component\DependencyInjection\Argument\IteratorArgument;

class Person
{
	private $identity;

	public function __construct(Identity $identity)
	{
		$this->identity = $identity;
	}

	public function getIdentity()
	{
		return $this->identity;
	}
}

class Identity
{
	private $identity = array();

	public function __construct($id)
	{
		$this->identity[$id['id']] = $id['name'];
	}

	public function addIdentity($id, $name)
	{
		return $this->identity[$id] = $name;
	}

	public function getIdentity($name)
	{
		if(!isset($this->identity[$name])) {
			throw new RuntimeExeption('xxxxx');
		}
		return $this->identity[$name];
	}

	public function getIdentities()
	{
		return $this->identity;
	}

}

class AliasIdentity
{

}

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

class Configurator
{
	public function config()
	{

	}
}
// $parameter = new ServiceClosureArgument(new Reference('srv.reference'));
// $iterator = new IteratorArgument(array(new Reference('srv.reference'), new Reference('srv.reference2')));
$configurator = array(new Reference('srv.configurator'), 'config');

$container = new ContainerBuilder();
$container->setParameter('id', 'aaaa');
// $container->setParameter('ref', $parameter);
// $container->setParameter('iterator', $iterator);
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
	->addArgument('%iterator%')->setLazy(true);
	// ->addArgument('%id2%');
$test = $container->get('srv.test');

var_dump(class_implements($test));

$test->printValue('aaallllbbb');

//$test2 = $container->get('srv.test');
//var_dump($test->getValue());
exit;










/**
 * setParameter
 */
$container->setParameter('id', array('id' => 'husbund', 'name' => 'albertshen'));
$container->setParameter('prop', 'name');

// $container->setAlias('alias.identity', 'srv.identity');
// $container->setAlias('alias.identity', 'srv.identity');
$container
	->register('alias.identity', 'AliasIdentity');

$container
	->register('srv.identity', 'Identity')
	->addArgument('%id%');

$container
	->register('srv.person', 'Person')
	->addArgument(new Reference('alias2.identity'))
	->setPublic(false) //just for mark
	;

$container->setAlias('alias.identity', 'srv.identity');
$container->setAlias('alias2.identity', 'alias.identity');

var_dump(array_keys($container->getDefinitions()));
var_dump($container->getAliases());


$person = $container->get('srv.person');
$identity = $person->getIdentity();
$identity->addIdentity('wife', 'nisa');
$identity->addIdentity('son', 'stein');
var_dump($identity->getIdentities());
//$container->get('mail.send');
//
//
//














