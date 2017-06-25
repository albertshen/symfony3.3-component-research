<?php

require_once __DIR__.'/../vendor/autoload.php';

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\DependencyInjection\Extension\Extension;


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
	public function setMailer($mailer)
	{

	}
}


//$container->get('mailer');


class AcmeDemoExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new YamlFileLoader($container, new FileLocator(__DIR__.DIRECTORY_SEPARATOR.'../config'));
        $loader->load('services.yml');
        //var_dump($configs);
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


$container->compile();

//$container->get('mailer');


