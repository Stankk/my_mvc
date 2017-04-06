<?php

define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(dirname(__FILE__)));

$url = $_GET['url'];
require_once (ROOT . DS . '/my_mvc' . DS . 'library' . DS . 'bootstrap.php');

//Notice that I have purposely not included the closing ?><!--. This is to avoid injection of any extra whitespaces in our output. For more, I suggest you view Zend's <a href="http://framework.zend.com/manual/en/coding-standard.coding-style.html">coding style</a>.-->
<!---->
<!--    Our index.php basically set the $url variable and calls bootstrap.php which resides in our library directory.-->
<!---->
<!--    Now lets view our bootstrap.php-->


<?php

require_once (ROOT . DS . '/my_mvc' . DS . 'config' . DS . 'config.php');
require_once (ROOT . DS . '/my_mvc' . DS . 'library' . DS . 'shared.php');

//
//Yes these requires could be included directly in index.php. But have not been on purpose to allow future expansion of code.
//
//Now let us have a look at shared.php, finally something that does some real work <img src="https://s.w.org/images/core/emoji/72x72/1f642.png" alt="🙂" class="emoji" draggable="false">
//
 
/** Check if environment is development and display errors **/
 
function setReporting() {
if (DEVELOPMENT_ENVIRONMENT == true) {
    error_reporting(E_ALL);
    ini_set('display_errors','On');
} else {
    error_reporting(E_ALL);
    ini_set('display_errors','Off');
    ini_set('log_errors', 'On');
    ini_set('error_log', ROOT.DS.'tmp'.DS.'logs'.DS.'error.log');
}
}
 
/** Check for Magic Quotes and remove them **/
 
function stripSlashesDeep($value) {
    $value = is_array($value) ? array_map('stripSlashesDeep', $value) : stripslashes($value);
    return $value;
}
 
function removeMagicQuotes() {
if ( get_magic_quotes_gpc() ) {
    $_GET    = stripSlashesDeep($_GET   );
    $_POST   = stripSlashesDeep($_POST  );
    $_COOKIE = stripSlashesDeep($_COOKIE);
}
}
 
/** Check register globals and remove them **/
 
function unregisterGlobals() {
    if (ini_get('register_globals')) {
        $array = array('_SESSION', '_POST', '_GET', '_COOKIE', '_REQUEST', '_SERVER', '_ENV', '_FILES');
        foreach ($array as $value) {
            foreach ($GLOBALS[$value] as $key => $var) {
                if ($var === $GLOBALS[$key]) {
                    unset($GLOBALS[$key]);
                }
            }
        }
    }
}
 
/** Main Call Function **/
 
function callHook() {
    global $url;
 
    $urlArray = array();
    $urlArray = explode("/",$url);
 
    $controller = $urlArray[0];
    array_shift($urlArray);
    $action = $urlArray[0];
    array_shift($urlArray);
    $queryString = $urlArray;
 
    $controllerName = $controller;
    $controller = ucwords($controller);
    $model = rtrim($controller, 's');
    $controller .= 'Controller';
    $dispatch = new $controller($model,$controllerName,$action);
 
    if ((int)method_exists($controller, $action)) {
        call_user_func_array(array($dispatch,$action),$queryString);
    } else {
        /* Error Generation Code Here */
    }
}
 
/** Autoload any classes that are required **/
 
function __autoload($className) {
    if (file_exists(ROOT . DS . '/my_mvc' . DS . 'library' . DS . strtolower($className) . '.class.php')) {
        require_once(ROOT . DS . '/my_mvc' . DS . 'library' . DS . strtolower($className) . '.class.php');
    } else if (file_exists(ROOT . DS . '/my_mvc' . DS . 'application' . DS . 'controllers' . DS . strtolower($className) . '.php')) {
        require_once(RROOT . DS . '/my_mvc' . DS . 'application' . DS . 'controllers' . DS . strtolower($className) . '.php');
    } else if (file_exists(ROOT . DS . '/my_mvc' . DS . 'application' . DS . 'models' . DS . strtolower($className) . '.php')) {
        require_once(ROOT . DS . '/my_mvc' . DS . 'application' . DS . 'models' . DS . strtolower($className) . '.php');
    } else {
        /* Error Generation Code Here */
    }
}
 
setReporting();
removeMagicQuotes();
unregisterGlobals();
callHook();