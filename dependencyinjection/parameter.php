<?php

require_once __DIR__.'/vendor/autoload.php';

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class Person
{
	private $identity;

	public function __construct($identity)
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

	public function __construct($name = 'albertshen')
	{
		$this->identity['husbund'] = $name;
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

$container = new ContainerBuilder();

/**
 * setParameter
 */
$container->setParameter('id', '%prop%');
$container->setParameter('prop', 'name');


$container
	->register('srv.identity', 'Identity')
	->addArgument('%%%%id%');

$container
	->register('srv.person', 'Person')
	->addArgument(new Reference('srv.identity'))
	;


$person = $container->get('srv.person');
$identity = $person->getIdentity();
$identity->addIdentity('wife', 'nisa');
$identity->addIdentity('son', 'stein');
var_dump($identity->getIdentities());
//$container->get('mail.send');
//
//
//














