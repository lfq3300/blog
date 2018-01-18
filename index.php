<?php

define('APP_DEBUG',True);
define('BIND_MODULE','Home');
define ( 'APP_PATH', './Application/' );
define ('RUNTIME_PATH', './Runtime/');
define('BASE_PATH',str_replace('\\','/',realpath(dirname(__FILE__).'/'))."/");
require './ThinkPHP/ThinkPHP.php';


