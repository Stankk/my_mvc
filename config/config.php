<?php

/** Configuration Variables **/

define ('DEVELOPMENT_ENVIRONMENT',true);

define('DB_NAME', 'yourdatabasename');
define('DB_USER', 'yourusername');
define('DB_PASSWORD', 'yourpassword');
define('DB_HOST', 'localhost');

//
//CREATE TABLE `items` (
//`id` int(11) NOT NULL auto_increment,
//  `item_name` varchar(255) NOT NULL,
//  PRIMARY KEY  (`id`)
//);
//
//INSERT INTO `items` VALUES(1, 'Get Milk');
//INSERT INTO `items` VALUES(2, 'Buy Application');
//



class Item extends Model {

}


class ItemsController extends Controller {

    function view($id = null,$name = null) {

        $this->set('title',$name.' - My Todo List App');
        $this->set('todo',$this->Item->select($id));

    }

    function viewall() {

        $this->set('title','All Items - My Todo List App');
        $this->set('todo',$this->Item->selectAll());
    }

    function add() {
        $todo = $_POST['todo'];
        $this->set('title','Success - My Todo List App');
        $this->set('todo',$this->Item->query('insert into items (item_name) values (\''.mysql_real_escape_string($todo).'\')'));
    }

    function delete($id = null) {
        $this->set('title','Success - My Todo List App');
        $this->set('todo',$this->Item->query('delete from items where id = \''.mysql_real_escape_string($id).'\''));
    }

}