<?php class ItemModel extends Model
{
    public function __construct()
    {
        // Load core model functions
        parent::__construct();
    }

    public function getAll() {
        // Return the database query using Mysqlidb database class return
        $this->db->get('item');
    }
}