<?php

require_once __DIR__.'/../vendor/autoload.php';

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

$container = new ContainerBuilder();
$loader = new YamlFileLoader($container, new FileLocator(__DIR__.DIRECTORY_SEPARATOR.'../config'));
$loader->load('services.yml');
// var_dump($container->getDefinitions());
$container->get('mailer');

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