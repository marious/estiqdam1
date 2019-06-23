<?php
class Dashboard extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware->execute_middlewares(['not_authinticated']);
        $this->data['view_module'] = 'dashboard';
    }

    public function index()
    {
        $this->admin_template('index', $this->data);
    }
}