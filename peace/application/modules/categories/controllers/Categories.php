<?php
class Categories extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Category_model');
    }

    public function load_expense_categories()
    {
        $this->Category_model->get_expense_categories();
    }



}