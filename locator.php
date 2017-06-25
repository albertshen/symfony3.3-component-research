<?php

require_once __DIR__.'/vendor/autoload.php';

use Symfony\Component\Config\FileLocator;

$configDirectories = array(__DIR__.'/config', __DIR__.'/cache');

$locator = new FileLocator($configDirectories);
$yamlUserFiles = $locator->locate('database.yml', null, false);

var_dump($yamlUserFiles);exit;