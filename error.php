<?php

$id = '1111'; 
$normalizedId = '33333';

trigger_error(sprintf('Service identifiers will be made case sensitive in Symfony 4.0. Using "%s" instead of "%s" is deprecated since version 3.3.', $id, $normalizedId), E_USER_NOTICE);

var_dump(3333);