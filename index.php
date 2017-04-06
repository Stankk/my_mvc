<?php
/**
 * Created by PhpStorm.
 * User: apprenant
 * Date: 06/04/17
 * Time: 11:02
 */

// Directory separator is set up here because separators are different on Linux and Windows operating systems define
define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(dirname(__FILE__))); $url = $_GET['url'];
require_once(ROOT . DS . 'core' . DS . 'bootstrap.php');