<?php

require_once __DIR__.'/vendor/autoload.php';

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

$container = new ContainerBuilder();
$loader = new YamlFileLoader($container, new FileLocator(__DIR__.'/config'));
$loader->load('service.yml');

$container->get('mailer')->getParameter();
// $container = new ContainerBuilder();

// $container->setParameter('mailer.transport', 'xx');
// $container
//     ->register('mailer', 'Symfony\Component\DependencyInjection\Mailer')
//     ->addArgument('%mailer.transport%')
//     ->addArgument(array('34' => '34uu'));
//     
// $container
//     ->register('albert', 'Albert')
//     ->addArgument(array('34' => '34uu'));

//$container->get('mailer')->getParameter();


class Mailer 
{
    private $transport;

    const NISA = 'AAAd';
    const NISA2 = 'AAA';


    public function __construct($param) 
    {
        $this->transport = $param;
    }
    public function getParameter()
    {
        var_dump($this->transport);
    }
}








// $name = 'st.albert.sh';
// $key = 'test.albert.shen';
// $aaa = levenshtein($key, $name);
// var_dump('levenshtein: '.$aaa);
// var_dump('namelength: '.strlen($name));
// var_dump('strpos: '.strpos($key, $name));

// $value = array('%dsf%', '%sa.dsaf%', array('fa' => 'fs'));

// var_dump(resolveValue($value));exit;

//     function resolveValue($value, array $resolving = array())
//     {
//         if (is_array($value)) {
//             $args = array();
//             foreach ($value as $k => $v) {
//                 $args[resolveValue($k, $resolving)] = resolveValue($v, $resolving);
//             }

//             return $args;
//         }

//         if (!is_string($value)) {
//             return $value;
//         }

//         return $value;
//     }

// use Symfony\Component\Config\FileLocator;
// use Symfony\Component\Config\Loader\FileLoader;
// use Symfony\Component\Yaml\Yaml;
// use Symfony\Component\Config\Loader\LoaderResolver;
// use Symfony\Component\Config\Loader\DelegatingLoader;

// $configDirectories = array(__DIR__.'/config');

// $locator = new FileLocator($configDirectories);
// //$yamlUserFiles = $locator->locate('db.yml', null, false);
// // var_dump($yamlUserFiles);exit;
// // var_dump($locator);exit;
// // 
// class YamlUserLoader extends FileLoader
// {
// 	public $albert;

//     public function load($resource, $type = null)
//     {
//         var_dump($resource);exit;
//         $configValues = Yaml::parse(file_get_contents($resource));
// 		return $configValues;
// 		// var_dump($this->albert);exit;
//         // ... handle the config values

//         // maybe import some other resource:

//         //$this->import($resource);
//     }

//     public function supports($resource, $type = null)
//     {
//         return is_string($resource) && 'yml' === pathinfo(
//             $resource,
//             PATHINFO_EXTENSION
//         );
//     }
// }

// $loaderResolver = new LoaderResolver(array(new YamlUserLoader($locator)));
// $delegatingLoader = new DelegatingLoader($loaderResolver);

// $aa = $delegatingLoader->load(__DIR__.'/config/db.yml');

// var_dump($aa);


