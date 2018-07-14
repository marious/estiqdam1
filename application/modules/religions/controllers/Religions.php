<?php

class Religions extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Religion_model');
    }
}