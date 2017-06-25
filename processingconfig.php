<?php

require_once __DIR__.'/vendor/autoload.php';
require_once __DIR__.'/DatabaseConfiguration.php';

use Symfony\Component\Yaml\Yaml;
use Symfony\Component\Config\Definition\Processor;
use Symfony\Component\Config\Definition\Dumper\YamlReferenceDumper;

$config1 = Yaml::parse(
    file_get_contents(__DIR__.'/config/database.yml')
);
$config2 = Yaml::parse(
    file_get_contents(__DIR__.'/config/database2.yml')
);

$configs = array($config1, $config2);

$processor = new Processor();
$configuration = new DatabaseConfiguration();

//$dumper = new YamlReferenceDumper();
//var_dump($dumper->dump($configuration));

	$processedConfiguration = $processor->processConfiguration(
	    $configuration,
	    $configs
	);
var_dump($processedConfiguration);exit;
	//var_dump($processedConfiguration);exit;
// try{
// 	$processedConfiguration = $processor->processConfiguration(
// 	    $configuration,
// 	    $configs
// 	);
// } catch (\RuntimeException $e) {
// 	var_dump($e->getMessage());
// }




//var_dump($processedConfiguration);











