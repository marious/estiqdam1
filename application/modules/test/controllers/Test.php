<?php

class Test extends MY_Controller
{

    public function index()
    {
        $this->load->view('index');
    }

    public function contract()
    {
        $this->load->view('contract');
    }

}