<?php
/**
 * Created by PhpStorm.
 * User: apprenant
 * Date: 06/04/17
 * Time: 11:05
 */

// Load configuration and helper functions
require_once(ROOT . DS . 'config' . DS . 'config.php');
require_once(ROOT . DS . 'core' . DS . 'functions.php');
// Autoload classes
function __autoload($className)
{
    if (file_exists(ROOT . DS . 'core' . DS . strtolower($className) . '.php'))
        {
            require_once(ROOT . DS . 'core' . DS . strtolower($className) . '.php');
        }
    else if (file_exists(ROOT . DS . 'application' . DS . 'controllers' . DS . strtolower($className) . '.php'))
        {
        require_once(ROOT . DS . 'application' . DS . 'controllers' . DS . strtolower($className) . '.php');
        }
    else if (file_exists(ROOT . DS . 'application' . DS . 'models' . DS . $className . '.php'))
        {
        require_once(ROOT . DS . 'application' . DS . 'models' . DS . $className . '.php');
        }
    else if (file_exists(ROOT . DS . 'core' . DS . 'sql.php'))
        {
        require_once(ROOT . DS . 'core' . DS . 'sql.php');
    }
}
// Route the request
Router::route($url);