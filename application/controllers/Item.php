<?php

class Item extends Controller
{
    public function __construct($controller,$action)
    {
        // Load core controller
        parent::__construct($controller, $action);
        // Load models $this->load_model('CategoryModel');
        $this->load_model('ItemModel');
    }

    public function index()
    {
        // Load search page
        $this->search();
    }

    public function search()
    {
        $items = $this->get_model('ItemModel')->getAll();
        // Set view variables
        $this->get_view()->set('items', $items);
        // Render view
        $this->get_view()->render('item/item_list_view');
    }
}