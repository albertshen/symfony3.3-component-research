<?php

require_once __DIR__.'/../vendor/autoload.php';

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\DependencyInjection\Person;
use Symfony\Component\DependencyInjection\Identity;


$container = new ContainerBuilder();

$container->setParameter('id', 'albertshen');
$container->setParameter('prop', 'name');

$container
	->autowire(Identity::class)
	->addArgument('%id%');

$container
	->autowire(Person::class)
	->addArgument(new Reference(Identity::class));

$container->compile();

$person = $container->get(Person::class);
$identity = $person->getIdentity();
$identity->addIdentity('wife', 'nisa');
$identity->addIdentity('son', 'stein');
var_dump($identity->getIdentities());








