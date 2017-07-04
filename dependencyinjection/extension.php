<?php

require_once __DIR__.'/../vendor/autoload.php';

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Dumper\PhpDumper;
use Symfony\Component\Config\ConfigCache;
use Symfony\Component\Config\Resource\FileResource;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\DependencyInjection\Identity;
use Symfony\Component\DependencyInjection\Person;

class Mailer
{
	private $transport;

	public function __construct($transport)
	{
		$this->transport = $transport;
		//var_dump($this->transport);
	}


}

class NewsletterManager
{
    private $mailer;

	public function setMailer($mailer)
	{
        $this->mailer = $mailer;
        var_dump($this->mailer);
	}

}


//$container->get('mailer');


class AcmeDemoExtension extends Extension implements CompilerPassInterface
{
    public function load(array $configs, ContainerBuilder $container)
    {//var_dump($configs);
        $loader = new YamlFileLoader($container, new FileLocator(__DIR__.DIRECTORY_SEPARATOR.'../config'));
        $loader->load('services.yml');
        $container->setParameter('acme_demo.FOO', $configs[0]['foo']);
    }

    public function getAlias()
    {
        return 'albert_shen';
    }

    public function process(ContainerBuilder $container)
    {
        $container->setParameter('acme_demo.FOO', 111);
        //var_dump($container->getServiceIds());
    }
}


class AcmeDemo2Extension extends Extension implements CompilerPassInterface
{
    public function load(array $configs, ContainerBuilder $container)
    {
        $container->setParameter('id', 'albertshen');
        $container->setParameter('prop', 'name');
        $container->setParameter('acme_demo.FOO', $configs[0]['foo']);

        $container
            ->autowire(Identity::class)
            ->addArgument('%id%');

        $container
            ->autowire(Person::class)
            ->addArgument(new Reference(Identity::class));
    }

    public function getAlias()
    {
        return 'albert_shen2';
    }

    public function process(ContainerBuilder $container)
    {
        $container->setParameter('acme_demo.FOO', 222);
        var_dump($container->getServiceIds());
    }
}


$container = new ContainerBuilder();
$extension = new AcmeDemoExtension;
$extension2 = new AcmeDemo2Extension;
//$container->setParameter('acme_demo.FOO', 'nisa');
$container->registerExtension($extension);
$container->registerExtension($extension2);
// $loader = new YamlFileLoader($container, new FileLocator(__DIR__.DIRECTORY_SEPARATOR.'../config'));
// $loader->load('config.yml');
$container->loadFromExtension($extension->getAlias(), array('foo' => 'fooValue1', 'bar' => 'barValue2'));
$container->loadFromExtension($extension2->getAlias(), array('foo' => 'fooValue2', 'bar' => 'barValue2'));

 $container->compile();

var_dump($container->getParameter('acme_demo.FOO'));
// exit;

// $container->get('newsletter_manager');



exit;

$file = __DIR__ .'/../cache/container.php';
$configCache = new ConfigCache($file, true);
// $path = __DIR__.DIRECTORY_SEPARATOR.'../config';
// $resource = array(new FileResource($path.'/services.yml'));

if(!$configCache->isFresh()){
    $container->compile();
    $dumper = new PhpDumper($container);
    $configCache->write($dumper->dump(array('class' => 'AlbertContainer')), $container->getResources());
    // $configCache->write($dumper->dump(array('class' => 'AlbertContainer')), $resource);
} else {
    require_once $file;
    $container = new AlbertContainer();
}

$container->get('newsletter_manager');



