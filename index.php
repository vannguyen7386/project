<?php
define('APPLICATION_PATH', 
              realpath(dirname(__FILE__) . '/application')); 
define('APPLICATION_ENV','production'); 
set_include_path(APPLICATION_PATH . '/../library'); 

require_once 'Zend/Application.php' ;
require_once 'lib/Data.php';
require_once 'lib/Debug.php';
require_once 'lib/Request.php';
$application = new Zend_Application( 
    APPLICATION_ENV, 
    APPLICATION_PATH . '/configs/application.ini' 
); 
$baseUrl = str_ireplace('\\', '/', dirname($_SERVER['PHP_SELF']));
$baseUrl = preg_replace('/^\/$/is', '', $baseUrl);
defined('BASE_URL') || define('BASE_URL', $baseUrl);
$application->bootstrap()->run();
?>
