<?php

if($_SERVER['DOCUMENT_ROOT'] === __DIR__){
  throw new \Exception('You MUST NOT install your frdlweb-project into an public web directory [<a href="https://github.com/frdl/project#webadmin">Read this documentation</a>]');
}


require __DIR__.\DIRECTORY_SEPARATOR .'web'.\DIRECTORY_SEPARATOR .'admin.php';

$run();
