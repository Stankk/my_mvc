<?php

/**
 * Created by PhpStorm.
 * User: apprenant
 * Date: 06/04/17
 * Time: 15:27
 */
class Template
{

    protected $variables = array();
    protected $_controller;
    protected $_action;

    function __construct($controller,$action) {
        $this->_controller = $controller;
        $this->_action = $action;
    }

    /** Set Variables **/

    function set($name,$value) {
        $this->variables[$name] = $value;
    }

    /** Display Template.class **/

    function render() {
        extract($this->variables);

        if (file_exists(ROOT . DS . 'application' . DS . 'views' . DS . $this->_controller . DS . 'header.php')) {
            include (ROOT . DS . 'application' . DS . 'views' . DS . $this->_controller . DS . 'header.php');
        } else {
            include (ROOT . DS . 'application' . DS . 'views' . DS . 'header.php');
        }

        include (ROOT . DS . 'application' . DS . 'views' . DS . $this->_controller . DS . $this->_action . '.php');

        if (file_exists(ROOT . DS . 'application' . DS . 'views' . DS . $this->_controller . DS . 'footer.php')) {
            include (ROOT . DS . 'application' . DS . 'views' . DS . $this->_controller . DS . 'footer.php');
        } else {
            include (ROOT . DS . 'application' . DS . 'views' . DS . 'footer.php');
        }
    }
}