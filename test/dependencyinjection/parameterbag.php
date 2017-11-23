<?php

require_once __DIR__.'/../vendor/autoload.php';

use Symfony\Component\DependencyInjection\ParameterBag\EnvPlaceholderParameterBag;

$envParameterBag = new EnvPlaceholderParameterBag();

var_dump($envParameterBag->get('env(SERVER)'));


var_dump($envParameterBag->getEnvPlaceholders());