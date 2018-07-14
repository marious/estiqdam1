<?php

class Services_contract extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->adminSecurity();
        $this->load->model('Service_contract_model');
    }
}