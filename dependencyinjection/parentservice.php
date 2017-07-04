<?php

require_once __DIR__.'/../vendor/autoload.php';

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\DependencyInjection\ChildDefinition;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Dumper\PhpDumper;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Person;
use Symfony\Component\DependencyInjection\Identity;
use Symfony\Component\DependencyInjection\Child;

class AcmeDemoExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container)
    {
		$container->setParameter('id', 'albertshen');
		$container->setParameter('prop', 'name');


		$container
			->autowire(Identity::class)
			->addArgument('%id%');

		$container
			->autowire(Person::class)
			->addArgument(new Reference(Identity::class));

		$definition = new ChildDefinition(Person::class);
		$definition->setClass(Child::class);
		$container->setDefinition(Child::class, $definition);
    }

    public function getAlias()
    {
        return 'albert_shen';
    }
}

$container = new ContainerBuilder();
$container->registerExtension(new AcmeDemoExtension);

$loader = new YamlFileLoader($container, new FileLocator(__DIR__.DIRECTORY_SEPARATOR.'../config'));
$loader->load('config.yml');

$file = __DIR__ .'/../cache/parent_container.php';

if (file_exists($file)) {
    require_once $file;
    $container = new ParentContainer();
} else {
    $container->compile();
    $dumper = new PhpDumper($container);
    file_put_contents($file, $dumper->dump(array('class' => 'ParentContainer')));
}

$person = $container->get(Child::class);
$identity = $person->getIdentity();
$identity->addIdentity('wife', 'nisa');
$identity->addIdentity('son', 'stein');
var_dump($identity->getIdentities());














