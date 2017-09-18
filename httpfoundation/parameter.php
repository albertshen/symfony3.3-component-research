<?php

require_once __DIR__.'/../vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\ParameterBag;

$request = Request::createFromGlobals();
var_dump($request->cookies->all());
var_dump($request->headers->all());
var_dump($request->request->all());
var_dump($request->getContent());
// var_dump($request);
exit;
$pb = new ParameterBag;

var_dump($pb->getAlpha('ffa', 'sa33adf'));
var_dump($pb->getAlnum('ffa', 'sa33adf'));
var_dump($pb->getDigits('ffa', 'sa33adf'));