<?php

class Dashboard extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->adminSecurity();
    }

    public function index()
    {
        $this->adminTemplate('index', $this->data);
    }
}