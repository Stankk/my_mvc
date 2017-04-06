<?php

/**
 * Created by PhpStorm.
 * User: apprenant
 * Date: 06/04/17
 * Time: 11:44
 */
class Model {
    protected $db;
    public function __construct()
    {
        $this->db = new MysqliDb(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    }
}
